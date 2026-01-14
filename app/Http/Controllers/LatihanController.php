<?php

namespace App\Http\Controllers;

use App\Models\BobotPenilaianModel;
use App\Models\DetailLatihanModel;
use App\Models\KriteriaModel;
use App\Models\LatihanModel;
use App\Models\PemainModel;
use App\Models\PosisiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LatihanController extends Controller
{
    public function index()
    {
        $latihan = LatihanModel::all();
        return view('admin.pages.latihan.index', [
            'title' => 'Latihan',
            'active' => 'Latihan',
            'latihan' => $latihan,
        ]);
    }

    public function create()
    {
        $kriteria = KriteriaModel::all();
        $posisi = PosisiModel::with('pemain')->get();

        return view('admin.pages.latihan.create', [
            'title' => 'Latihan',
            'active' => 'Latihan',
            'kriteria' => $kriteria,
            'posisi' => $posisi,
        ]);
    }

    public function edit($id)
    {
        $posisi = PosisiModel::all();
        $latihan = LatihanModel::findOrFail($id);

        return view('admin.pages.latihan.edit', [
            'title' => 'Latihan',
            'active' => 'Latihan',
            'posisi' => $posisi,
            'latihan' => $latihan
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:latihan,name',
            'tanggal' => 'required|date|unique:latihan,tanggal',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Format yang diperbolehkan: :values.',
            'unique' => 'tanggal atau nama latihan sudah digunakan.',
        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan latihan
            $latihan = LatihanModel::create($validated);

            // 2. Ambil semua pemain
            $pemainIds = PemainModel::pluck('id');

            // 3. Simpan detail latihan
            foreach ($pemainIds as $pemainId) {
                DetailLatihanModel::create([
                    'latihan_id' => $latihan->id,
                    'pemain_id' => $pemainId,
                    'status_pemain' => 1,
                    'status' => 1,
                ]);
            }

            // 4. Jika semua sukses → commit
            DB::commit();

            return redirect('/latihan')->with('success', 'Data berhasil ditambahkan.');

        } catch (\Throwable $e) {

            // ❌ Jika ada error → batalkan semua
            DB::rollBack();

            return back()->with('error', 'Gagal menyimpan data. ' . $e->getMessage());
        }
    }



    public function update(Request $request, $id)
    {
        $latihan = LatihanModel::find($id);

        if (!$latihan) {
            return redirect('/latihan')->with('error', 'Data latihan tidak ditemukan.');
        }

        // Validasi
        $validated = $request->validate([
            'name' => 'required|unique:latihan,name,' . $id,
            'tanggal' => 'required|date|unique:latihan,tanggal,' . $id,
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Format yang diperbolehkan: :values.',
            'unique' => 'tanggal atau nama latihan sudah digunakan.',
        ]);

        // Update data
        $latihan->update($validated);

        return redirect('/latihan')->with('success', 'Data Berhasil Diperbarui!');
    }


    public function destroy(int $id)
    {
        $latihan = LatihanModel::find($id);

        if (!$latihan) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $latihan->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
}
