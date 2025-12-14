<?php

namespace App\Http\Controllers;

use App\Models\BobotPosisiModel;
use App\Models\KriteriaModel;
use App\Models\PosisiModel;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function index()
    {
        $posisi = PosisiModel::all();
        return view('admin.pages.posisi.index', [
            'title' => 'Posisi',
            'active' => 'Posisi',
            'posisi' => $posisi,
        ]);
    }

    public function create()
    {
        $kriteria = KriteriaModel::all();

        return view('admin.pages.posisi.create', [
            'title' => 'Posisi',
            'active' => 'Posisi',
            'kriteria' => $kriteria
        ]);
    }

    public function edit($id)
    {
        $kriteria = KriteriaModel::all();
        $posisi = PosisiModel::findOrFail($id);

        $pivot = BobotPosisiModel::where('posisi_id', $id)
            ->get()
            ->keyBy('kriteria_id');

        return view('admin.pages.posisi.edit', [
            'title' => 'Posisi',
            'active' => 'Posisi',
            'pivot' => $pivot,
            'kriteria' => $kriteria,
            'posisi' => $posisi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:posisi,name',
            'bobot.*' => 'required|numeric'
        ]);

        // Simpan posisi
        $posisi = PosisiModel::create([
            'name' => $request->name,
        ]);

        // Hitung total bobot
        $total = array_sum($request->bobot);

        // Simpan bobot per kriteria
        foreach ($request->bobot as $kriteria_id => $bobot) {
            BobotPosisiModel::create([
                'posisi_id' => $posisi->id,
                'kriteria_id' => $kriteria_id,
                'bobot' => $bobot,
                'bobot_wj' => $bobot / $total,
            ]);
        }

        return redirect('/posisi')->with('success', 'Data berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:posisi,name,' . $id,
            'bobot.*' => 'required|numeric'
        ]);

        $posisi = PosisiModel::find($id);

        $posisi->update([
            'name' => $request->name
        ]);

        $total = array_sum($request->bobot);

        foreach ($request->bobot as $kriteria_id => $bobot) {
            BobotPosisiModel::updateOrCreate(
                [
                    'posisi_id' => $id,
                    'kriteria_id' => $kriteria_id
                ],
                [
                    'bobot' => $bobot,
                    'bobot_wj' => $bobot / $total
                ]
            );
        }

        return redirect('/posisi')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $posisi = PosisiModel::find($id);

        if (!$posisi) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $posisi->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
}
