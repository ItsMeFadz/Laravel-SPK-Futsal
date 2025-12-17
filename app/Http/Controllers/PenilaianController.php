<?php

namespace App\Http\Controllers;

use App\Models\DetailLatihanModel;
use App\Models\KriteriaModel;
use App\Models\LatihanModel;
use App\Models\BobotPenilaianModel;
use Illuminate\Http\Request;

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

}
