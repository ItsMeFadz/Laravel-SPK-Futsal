<?php

namespace App\Http\Controllers;

use App\Models\PemainModel;
use App\Models\PosisiModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\{Validator, Storage};

class PemainController extends Controller
{
    public function index()
    {
        $pemain = PemainModel::all();
        return view('admin.pages.pemain.index', [
            'title' => 'Pemain',
            'active' => 'Pemain',
            'pemain' => $pemain,
        ]);
    }

    public function create()
    {
        $posisi = PosisiModel::all();
        return view('admin.pages.pemain.create', [
            'title' => 'Pemain',
            'active' => 'Pemain',
            'posisi' => $posisi,
        ]);
    }
    
    public function edit($id)
    {
        $posisi = PosisiModel::all();
        return view('admin.pages.pemain.edit', [
            'title' => 'Pemain',
            'active' => 'Pemain',
            'pemain' => PemainModel::findOrFail($id),
            'posisi' => $posisi,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi (lebih singkat, efisien dan langsung melempar error otomatis)
        $validated = $request->validate([
            'kode_pemain' => 'required|unique:pemain,kode_pemain',
            'name' => 'required',
            'jk' => 'required',
            'kelas' => 'required',
            'umur' => 'required',
            'id_posisi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max.string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format: :values.',
            'unique' => 'Kode pemain sudah digunakan.',
        ]);

        // Upload gambar
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('foto_pemain', $fileName, 'public');
        }

        // Simpan
        PemainModel::create($validated);

        return redirect('/pemain')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pemain = PemainModel::find($id);

        if (!$pemain) {
            return redirect('/pemain')->with('error', 'Data pemain tidak ditemukan.');
        }

        // Validasi
        $validated = $request->validate([
            'kode_pemain' => 'required|unique:pemain,kode_pemain,' . $id,
            'name' => 'required',
            'jk' => 'required',
            'kelas' => 'required',
            'umur' => 'required',
            'id_posisi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Format yang diperbolehkan: :values.',
            'unique' => 'Kode pemain sudah digunakan.',
        ]);

        // Jika upload foto baru → hapus foto lama
        if ($request->hasFile('image')) {

            if ($pemain->image && Storage::disk('public')->exists($pemain->image)) {
                Storage::disk('public')->delete($pemain->image);
            }

            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('foto_pemain', $fileName, 'public');
        }

        // Update data
        $pemain->update($validated);

        return redirect('/pemain')->with('success', 'Data Berhasil Diperbarui!');
    }


    public function destroy(int $id)
    {
        $pemain = PemainModel::find($id);

        if (!$pemain) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        // Hapus foto
        if ($pemain->image && Storage::disk('public')->exists($pemain->image)) {
            Storage::disk('public')->delete($pemain->image);
        }

        $pemain->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
}
