<?php

namespace App\Http\Controllers;

use App\Models\BobotPenilaianModel;
use App\Models\BobotPosisiModel;
use App\Models\KriteriaModel;
use App\Models\LatihanModel;
use App\Models\PemainModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Symfony\Component\HttpFoundation\StreamedResponse;



class HasilPerhitunganController extends Controller
{
    public function index()
    {

        $pemain = PemainModel::with('posisi')->get();
        $kriteria = KriteriaModel::all();
        $latihanTerbaru = LatihanModel::latest('tanggal')->first();

        $bobotPenilaian = BobotPenilaianModel::where('latihan_id', $latihanTerbaru->id)
            ->get()
            ->keyBy(function ($item) {
                return $item->pemain_id . '-' . $item->kriteria_id;
            });

        $bobotPosisi = BobotPosisiModel::all()
            ->keyBy(function ($item) {
                return $item->posisi_id . '-' . $item->kriteria_id;
            });

        /**
         * =========================
         * 1. MATRIX KEPUTUSAN (X)
         * =========================
         */
        $matrixX = [];

        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {
                $key = $p->id . '-' . $k->id;
                $matrixX[$p->id][$k->id] = $bobotPenilaian[$key]->bobot ?? 0;
            }
        }

        /**
         * =========================
         * 2. NORMALISASI R
         * =========================
         */
        $pembagi = [];
        foreach ($kriteria as $k) {
            $sum = 0;
            foreach ($pemain as $p) {
                $sum += pow($matrixX[$p->id][$k->id], 2);
            }
            $pembagi[$k->id] = sqrt($sum);
        }

        $matrixR = [];
        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {
                $matrixR[$p->id][$k->id] =
                    $pembagi[$k->id] == 0 ? 0 :
                    $matrixX[$p->id][$k->id] / $pembagi[$k->id];
            }
        }

        /**
         * =========================
         * 3. NORMALISASI Y (WP)
         * =========================
         */
        $matrixY = [];
        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {

                $keyPosisi = $p->id_posisi . '-' . $k->id;
                $bobotWj = $bobotPosisi[$keyPosisi]->bobot_wj ?? 0;

                $matrixY[$p->id][$k->id] =
                    $matrixR[$p->id][$k->id] * $bobotWj;
            }
        }

        /**
         * =========================
         * 4. A+ dan A-
         * =========================
         */
        $Aplus = [];
        $Amin = [];

        foreach ($kriteria as $k) {
            $col = array_column($matrixY, $k->id);

            if ($k->atribut === 1) {
                $Aplus[$k->id] = max($col);
                $Amin[$k->id] = min($col);
            } else {
                $Aplus[$k->id] = min($col);
                $Amin[$k->id] = max($col);
            }
        }

        /**
         * =========================
         * 5. JARAK D+ dan D-
         * =========================
         */
        $Dplus = [];
        $Dmin = [];

        foreach ($pemain as $p) {
            $sumPlus = 0;
            $sumMin = 0;

            foreach ($kriteria as $k) {
                $sumPlus += pow($matrixY[$p->id][$k->id] - $Aplus[$k->id], 2);
                $sumMin += pow($matrixY[$p->id][$k->id] - $Amin[$k->id], 2);
            }

            $Dplus[$p->id] = sqrt($sumPlus);
            $Dmin[$p->id] = sqrt($sumMin);
        }

        /**
         * =========================
         * 6. NILAI PREFERENSI
         * =========================
         */
        $preferensi = [];
        foreach ($pemain as $p) {
            $preferensi[$p->id] =
                ($Dplus[$p->id] + $Dmin[$p->id]) == 0 ? 0 :
                $Dmin[$p->id] / ($Dplus[$p->id] + $Dmin[$p->id]);
        }

        /**
         * =========================
         * 7. PERANGKINGAN
         * =========================
         */
        $ranking = [];

        foreach ($pemain as $p) {
            $ranking[] = [
                'pemain' => $p,
                'nilai' => $preferensi[$p->id]
            ];
        }

        usort($ranking, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        // Tambah ranking (AMAN)
        foreach ($ranking as $i => $r) {
            $ranking[$i]['rank'] = $i + 1;
        }

        /**
         * =========================
         * 8. REKOMENDASI LINE UP
         * =========================
         */
        $lineUp = [];

        foreach ($ranking as $r) {
            $posisi = $r['pemain']->id_posisi;

            // Ambil pemain terbaik pertama per posisi
            if (!isset($lineUp[$posisi])) {
                $lineUp[$posisi] = $r;
            }
        }

        return view('admin.pages.HasilPerhitungan.index', [
            'title' => 'hasilPerhitungan',
            'active' => 'hasilPerhitungan',
            'lineUp' => $lineUp,
        ]);
    }

    private function getHasilData()
    {
        $pemain = PemainModel::with('posisi')->get();
        $kriteria = KriteriaModel::all();
        $latihanTerbaru = LatihanModel::latest('tanggal')->first();

        $bobotPenilaian = BobotPenilaianModel::where('latihan_id', $latihanTerbaru->id)
            ->get()
            ->keyBy(function ($item) {
                return $item->pemain_id . '-' . $item->kriteria_id;
            });

        $bobotPosisi = BobotPosisiModel::all()
            ->keyBy(function ($item) {
                return $item->posisi_id . '-' . $item->kriteria_id;
            });

        /**
         * =========================
         * 1. MATRIX KEPUTUSAN (X)
         * =========================
         */
        $matrixX = [];

        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {
                $key = $p->id . '-' . $k->id;
                $matrixX[$p->id][$k->id] = $bobotPenilaian[$key]->bobot ?? 0;
            }
        }

        /**
         * =========================
         * 2. NORMALISASI R
         * =========================
         */
        $pembagi = [];
        foreach ($kriteria as $k) {
            $sum = 0;
            foreach ($pemain as $p) {
                $sum += pow($matrixX[$p->id][$k->id], 2);
            }
            $pembagi[$k->id] = sqrt($sum);
        }

        $matrixR = [];
        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {
                $matrixR[$p->id][$k->id] =
                    $pembagi[$k->id] == 0 ? 0 :
                    $matrixX[$p->id][$k->id] / $pembagi[$k->id];
            }
        }

        /**
         * =========================
         * 3. NORMALISASI Y (WP)
         * =========================
         */
        $matrixY = [];
        foreach ($pemain as $p) {
            foreach ($kriteria as $k) {

                $keyPosisi = $p->id_posisi . '-' . $k->id;
                $bobotWj = $bobotPosisi[$keyPosisi]->bobot_wj ?? 0;

                $matrixY[$p->id][$k->id] =
                    $matrixR[$p->id][$k->id] * $bobotWj;
            }
        }

        /**
         * =========================
         * 4. A+ dan A-
         * =========================
         */
        $Aplus = [];
        $Amin = [];

        foreach ($kriteria as $k) {
            $col = array_column($matrixY, $k->id);

            if ($k->atribut === 1) {
                $Aplus[$k->id] = max($col);
                $Amin[$k->id] = min($col);
            } else {
                $Aplus[$k->id] = min($col);
                $Amin[$k->id] = max($col);
            }
        }

        /**
         * =========================
         * 5. JARAK D+ dan D-
         * =========================
         */
        $Dplus = [];
        $Dmin = [];

        foreach ($pemain as $p) {
            $sumPlus = 0;
            $sumMin = 0;

            foreach ($kriteria as $k) {
                $sumPlus += pow($matrixY[$p->id][$k->id] - $Aplus[$k->id], 2);
                $sumMin += pow($matrixY[$p->id][$k->id] - $Amin[$k->id], 2);
            }

            $Dplus[$p->id] = sqrt($sumPlus);
            $Dmin[$p->id] = sqrt($sumMin);
        }

        /**
         * =========================
         * 6. NILAI PREFERENSI
         * =========================
         */
        $preferensi = [];
        foreach ($pemain as $p) {
            $preferensi[$p->id] =
                ($Dplus[$p->id] + $Dmin[$p->id]) == 0 ? 0 :
                $Dmin[$p->id] / ($Dplus[$p->id] + $Dmin[$p->id]);
        }

        /**
         * =========================
         * 7. PERANGKINGAN
         * =========================
         */
        $ranking = [];

        foreach ($pemain as $p) {
            $ranking[] = [
                'pemain' => $p,
                'nilai' => $preferensi[$p->id]
            ];
        }

        usort($ranking, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        // Tambah ranking (AMAN)
        foreach ($ranking as $i => $r) {
            $ranking[$i]['rank'] = $i + 1;
        }

        /**
         * =========================
         * 8. REKOMENDASI LINE UP
         * =========================
         */
        $lineUp = [];

        foreach ($ranking as $r) {
            $posisi = $r['pemain']->id_posisi;

            // Ambil pemain terbaik pertama per posisi
            if (!isset($lineUp[$posisi])) {
                $lineUp[$posisi] = $r;
            }
        }

        return compact(
            'pemain',
            'kriteria',
            'matrixX',
            'ranking',
            'lineUp'
        );
    }

    public function exportPdf()
    {
        $data = $this->getHasilData();

        $pdf = Pdf::loadView('admin.pages.HasilPerhitungan.export-pdf', $data)
            ->setPaper('A4', 'portrait');

        return $pdf->download('hasil-rekomendasi-lineup.pdf');
    }

    public function exportExcel()
    {
        $data = $this->getHasilData();

        $pemain = $data['pemain'];
        $kriteria = $data['kriteria'];
        $matrixX = $data['matrixX'];
        $ranking = $data['ranking'];
        $lineUp = $data['lineUp'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $row = 1;

        /*
        ======================
        STYLE GLOBAL
        ======================
        */
        $titleStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E40AF'], // biru
            ],
        ];

        $sectionStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FACC15'], // kuning
            ],
        ];

        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB'], // abu
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        /*
        ======================
        HEADER
        ======================
        */
        $sheet->setCellValue("A{$row}", 'SMA NEGERI 1 DUKUPUNTANG');
        $sheet->mergeCells("A{$row}:F{$row}");
        $sheet->getStyle("A{$row}:F{$row}")->applyFromArray($titleStyle);
        $row++;

        $sheet->setCellValue("A{$row}", 'HASIL REKOMENDASI LINE UP FUTSAL');
        $sheet->mergeCells("A{$row}:F{$row}");
        $sheet->getStyle("A{$row}:F{$row}")->applyFromArray($titleStyle);
        $row += 2;

        /*
        ======================
        PENILAIAN PEMAIN
        ======================
        */
        $sheet->setCellValue("A{$row}", 'PENILAIAN PEMAIN');
        $sheet->mergeCells("A{$row}:F{$row}");
        $sheet->getStyle("A{$row}:F{$row}")->applyFromArray($sectionStyle);
        $row++;

        // Header
        $col = 'A';
        $sheet->setCellValue($col++ . $row, 'Alternatif');
        foreach ($kriteria as $k) {
            $sheet->setCellValue($col++ . $row, $k->kode);
        }

        $lastCol = chr(ord($col) - 1);
        $sheet->getStyle("A{$row}:{$lastCol}{$row}")->applyFromArray($headerStyle);
        $row++;

        // Data
        $startDataRow = $row;
        foreach ($pemain as $p) {
            $col = 'A';
            $sheet->setCellValue($col++ . $row, $p->kode_pemain);
            foreach ($kriteria as $k) {
                $sheet->setCellValue($col++ . $row, $matrixX[$p->id][$k->id]);
            }
            $row++;
        }
        $sheet->getStyle("A{$startDataRow}:{$lastCol}" . ($row - 1))
            ->applyFromArray($borderStyle);

        $row++;

        /*
        ======================
        PERANGKINGAN
        ======================
        */
        $sheet->setCellValue("A{$row}", 'PERANGKINGAN');
        $sheet->mergeCells("A{$row}:E{$row}");
        $sheet->getStyle("A{$row}:E{$row}")->applyFromArray($sectionStyle);
        $row++;

        $sheet->fromArray(['Kode', 'Nama', 'Posisi', 'Vi', 'Rank'], null, "A{$row}");
        $sheet->getStyle("A{$row}:E{$row}")->applyFromArray($headerStyle);
        $row++;

        $startRankRow = $row;
        foreach ($ranking as $r) {
            $sheet->fromArray([
                $r['pemain']->kode_pemain,
                $r['pemain']->name,
                $r['pemain']->posisi->name,
                number_format($r['nilai'], 4),
                $r['rank']
            ], null, "A{$row}");
            $row++;
        }
        $sheet->getStyle("A{$startRankRow}:E" . ($row - 1))
            ->applyFromArray($borderStyle);

        $row++;

        /*
        ======================
        LINE UP
        ======================
        */
        $sheet->setCellValue("A{$row}", 'HASIL REKOMENDASI LINE UP');
        $sheet->mergeCells("A{$row}:E{$row}");
        $sheet->getStyle("A{$row}:E{$row}")->applyFromArray($sectionStyle);
        $row++;

        $sheet->fromArray(['Kode', 'Nama', 'Posisi', 'Vi', 'Rank'], null, "A{$row}");
        $sheet->getStyle("A{$row}:E{$row}")->applyFromArray($headerStyle);
        $row++;

        $startLineRow = $row;
        foreach ($lineUp as $item) {
            $sheet->fromArray([
                $item['pemain']->kode_pemain,
                $item['pemain']->name,
                $item['pemain']->posisi->name,
                number_format($item['nilai'], 4),
                $item['rank']
            ], null, "A{$row}");
            $row++;
        }
        $sheet->getStyle("A{$startLineRow}:E" . ($row - 1))
            ->applyFromArray($borderStyle);

        /*
        ======================
        AUTO WIDTH
        ======================
        */
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        /*
        ======================
        DOWNLOAD
        ======================
        */
        $filename = 'hasil-rekomendasi-lineup.xlsx';

        return new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }


}
