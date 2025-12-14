<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\{Validator, Storage};

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        return view('admin.pages.kriteria.index', [
            'title' => 'Kriteria',
            'active' => 'Kriteria',
            'kriteria' => $kriteria,
        ]);
    }

    public function create()
    {
        return view('admin.pages.kriteria.create', [
            'title' => 'Kriteria',
            'active' => 'Kriteria'
        ]);
    }

    public function edit($id)
    {
        return view('admin.pages.kriteria.edit', [
            'title' => 'Kriteria',
            'active' => 'Kriteria',
            'kriteria' => KriteriaModel::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi (lebih singkat, efisien dan langsung melempar error otomatis)
        $validated = $request->validate([
            'kode' => 'required|unique:kriteria,kode',
            'name' => 'required',
            'bobot' => 'required',
            'atribut' => 'required',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max.string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format: :values.',
            'unique' => 'Kode kriteria sudah digunakan.',
        ]);

        // Simpan
        KriteriaModel::create($validated);

        return redirect('/kriteria')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kriteria = KriteriaModel::find($id);

        if (!$kriteria) {
            return redirect('/kriteria')->with('error', 'Data kriteria tidak ditemukan.');
        }

        // Validasi
        $validated = $request->validate([
            'kode' => 'required|unique:kriteria,kode,' . $id,
            'name' => 'required',
            'bobot' => 'required',
            'atribut' => 'required',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Format yang diperbolehkan: :values.',
            'unique' => 'Kode kriteria sudah digunakan.',
        ]);

        // Update data
        $kriteria->update($validated);

        return redirect('/kriteria')->with('success', 'Data Berhasil Diperbarui!');
    }


    public function destroy(int $id)
    {
        $kriteria = KriteriaModel::find($id);

        if (!$kriteria) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $kriteria->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
}
