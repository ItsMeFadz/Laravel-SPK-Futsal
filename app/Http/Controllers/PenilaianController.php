<?php

namespace App\Http\Controllers;

use App\Models\DetailLatihanModel;
use App\Models\KriteriaModel;
use App\Models\LatihanModel;
use App\Models\BobotPenilaianModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        // Ambil semua latihan
        $latihan = LatihanModel::all();

        // Ambil data pemain untuk setiap latihan
        $dataLatihan = [];
        foreach ($latihan as $l) {
            $dataLatihan[$l->id] = DetailLatihanModel::with('pemain.posisi')
                ->where('latihan_id', $l->id)
                ->distinct('pemain_id')
                ->get();
        }

        return view('admin.pages.penilaian.index', [
            'title' => 'Penilaian',
            'active' => 'Penilaian',
            'latihan' => $latihan,
            'dataLatihan' => $dataLatihan, // kirim ke view
        ]);
    }

    public function edit($id)
    {
        $penilaian = DetailLatihanModel::findOrFail($id);

        $kriteria = KriteriaModel::all();

        // ambil bobot penilaian sebelumnya
        $pivot = BobotPenilaianModel::where('latihan_id', $penilaian->latihan_id)
            ->where('pemain_id', $penilaian->pemain_id)
            ->get()
            ->keyBy('kriteria_id');

        return view('admin.pages.penilaian.edit', [
            'title' => 'Edit Penilaian',
            'active' => 'Penilaian',
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'pivot' => $pivot
        ]);
    }


    public function update(Request $request, $id)
    {
        $penilaian = DetailLatihanModel::findOrFail($id);

        $request->validate([
            'bobot.*' => 'required|numeric'
        ]);

        $total = array_sum($request->bobot);

        foreach ($request->bobot as $kriteria_id => $bobot) {

            BobotPenilaianModel::updateOrCreate(
                [
                    'latihan_id' => $penilaian->latihan_id,
                    'pemain_id' => $penilaian->pemain_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'bobot' => $bobot,
                ]
            );
        }

        DetailLatihanModel::where('latihan_id', $penilaian->latihan_id)
            ->where('pemain_id', $penilaian->pemain_id)
            ->update(['status' => 2]);

        return redirect('/penilaian')->with('success', 'Penilaian berhasil diperbarui!');
    }

    public function showDetail($detail_latihan_id)
    {
        $detail = DetailLatihanModel::with('pemain.posisi')->findOrFail($detail_latihan_id);

        $kriteria = KriteriaModel::all();

        $bobot = BobotPenilaianModel::where('latihan_id', $detail->latihan_id)
            ->where('pemain_id', $detail->pemain_id)
            ->get()
            ->keyBy('kriteria_id');

        return response()->json([
            'pemain' => [
                'name' => $detail->pemain->name,
                'posisi' => $detail->pemain->posisi->name,
                'image' => $detail->pemain->image, // contoh: pemain1.jpg
            ],
            'kriteria' => $kriteria,
            'bobot' => $bobot
        ]);

    }

    public function updateStatusPemain(Request $request)
    {
        $request->validate([
            'detail_latihan_id' => 'required|exists:detail_latihan,id',
            'status_pemain' => 'required|in:1,2,3',
        ]);

        $detail = DetailLatihanModel::findOrFail($request->detail_latihan_id);

        $detail->update([
            'status_pemain' => $request->status_pemain,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status pemain berhasil diperbarui'
        ]);
    }

    public function downloadExcel($latihan_id)
    {
        $latihan = LatihanModel::findOrFail($latihan_id);

        $pemain = DetailLatihanModel::with('pemain')
            ->where('latihan_id', $latihan_id)
            ->where('status_pemain', 1) // 🔥 FILTER
            ->get();

        $kriteria = KriteriaModel::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // HEADER
        $sheet->setCellValue('A1', 'kode_pemain');
        $col = 'B';
        foreach ($kriteria as $k) {
            $sheet->setCellValue($col . '1', $k->kode);
            $col++;
        }

        // DATA
        $row = 2;
        foreach ($pemain as $d) {
            $sheet->setCellValue('A' . $row, $d->pemain->kode_pemain);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Penilaian_' . $latihan->name . '.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'latihan_id' => 'required|exists:latihan,id',
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $spreadsheet = IOFactory::load($request->file('file'));
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // 1️⃣ HEADER
        $header = $rows[0];
        unset($rows[0]);

        // 2️⃣ PEMAIN EXCEL
        $pemainExcel = [];
        foreach ($rows as $row) {
            if (!empty($row[0])) {
                $pemainExcel[] = trim($row[0]);
            }
        }
        $pemainExcel = array_values(array_unique($pemainExcel));

        // 3️⃣ PEMAIN WAJIB
        $pemainWajib = DetailLatihanModel::where([
            'latihan_id' => $request->latihan_id,
            'status_pemain' => 1
        ])->with('pemain')
            ->get()
            ->pluck('pemain.kode_pemain')
            ->toArray();

        $kriteriaDb = KriteriaModel::pluck('kode')->toArray();
        $kriteriaExcel = array_slice($header, 1);

        foreach ($header as $i => $kode) {
            if ($i === 0)
                continue;

            if (!in_array($kode, $kriteriaDb)) {
                return back()->withErrors(
                    "Kriteria {$kode} di Excel tidak terdaftar di sistem"
                );
            }
        }

        DB::beginTransaction();

        try {

            sort($kriteriaDb);
            sort($kriteriaExcel);

            if ($kriteriaExcel !== $kriteriaDb) {
                throw new \Exception(
                    "Struktur kriteria Excel tidak sesuai dengan template yang didownload"
                );
            }

            foreach ($header as $i => $kode) {
                if ($i === 0)
                    continue;

                if (!in_array($kode, $kriteriaDb)) {
                    throw new \Exception(
                        "Kriteria {$kode} di Excel tidak terdaftar di sistem"
                    );
                }
            }

            // 4️⃣ BANDIKAN
            sort($pemainExcel);
            sort($pemainWajib);

            if ($pemainExcel !== $pemainWajib) {
                throw new \Exception("Daftar pemain di Excel tidak sesuai template");
            }


            foreach ($rows as $i => $row) {
                $kodePemain = $row[0];

                if (!$kodePemain)
                    continue;

                $pemain = \App\Models\PemainModel::where('kode_pemain', $kodePemain)->first();
                if (!$pemain) {
                    throw new \Exception("Kode pemain $kodePemain tidak ditemukan (baris " . ($i + 1) . ")");
                }

                // 🔒 Pastikan masih sehat
                $detail = DetailLatihanModel::where([
                    'latihan_id' => $request->latihan_id,
                    'pemain_id' => $pemain->id,
                    'status_pemain' => 1
                ])->first();

                if (!$detail) {
                    throw new \Exception("Pemain $kodePemain tidak valid / tidak sehat");
                }

                foreach ($header as $index => $kodeKriteria) {
                    if ($index === 0)
                        continue;

                    $nilai = $row[$index];
                    if ($nilai === null || $nilai === '')
                        continue;

                    $kriteria = KriteriaModel::where('kode', $kodeKriteria)->first();
                    if (!$kriteria) {
                        throw new \Exception("Kriteria {$kodeKriteria} tidak ditemukan");
                    }

                    if (!is_numeric($nilai)) {
                        throw new \Exception("Nilai untuk {$kodePemain} - {$kodeKriteria} harus berupa angka");
                    }

                    if ($nilai < 0 || $nilai > 10) {
                        throw new \Exception(
                            "Nilai {$kodePemain} - {$kodeKriteria} harus antara 0–10"
                        );
                    }


                    BobotPenilaianModel::updateOrCreate(
                        [
                            'latihan_id' => $request->latihan_id,
                            'pemain_id' => $pemain->id,
                            'kriteria_id' => $kriteria->id,
                        ],
                        [
                            'bobot' => $nilai
                        ]
                    );
                }

                $detail->update(['status' => 2]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }

        return redirect()->back()->with('success', 'Import Excel berhasil');
    }

}
