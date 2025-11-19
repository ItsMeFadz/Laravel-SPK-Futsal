<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Storage};
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::all();
        return view('admin.pages.pengguna.index', [
            'title' => 'Pengguna',
            'active' => 'Pengguna',
            'pengguna' => $pengguna,
        ]);
    }

    public function create()
    {
        return view('admin.pages.pengguna.create', [
            'title' => 'Pengguna',
            'active' => 'Pengguna'
        ]);
    }

    public function edit($id)
    {
        return view('admin.pages.pengguna.edit', [
            'title' => 'Pengguna',
            'active' => 'Pengguna',
            'pengguna' => User::findOrFail($id),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi (lebih singkat, efisien dan langsung melempar error otomatis)
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:8|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max.string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format: :values.',
            'unique' => 'username sudah digunakan.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Upload gambar
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('foto_pengguna', $fileName, 'public');
        }

        // Simpan
        User::create($validated);

        return redirect('/pengguna')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pengguna = User::find($id);

        if (!$pengguna) {
            return redirect('/pengguna')->with('error', 'Data pengguna tidak ditemukan.');
        }

        // Validasi
        $validated = $request->validate([
            // 'username' => 'required|unique:users,username' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'name' => 'required',
            'role' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Format yang diperbolehkan: :values.',
            'unique' => 'username sudah digunakan.',
        ]);

        // Jika upload foto baru → hapus foto lama
        if ($request->hasFile('image')) {

            if ($pengguna->image && Storage::disk('public')->exists($pengguna->image)) {
                Storage::disk('public')->delete($pengguna->image);
            }

            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('foto_pengguna', $fileName, 'public');
        }

        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Hapus jika kosong agar tidak merubah yang lama
        }

        // Update data
        $pengguna->update($validated);

        return redirect('/pengguna')->with('success', 'Data Berhasil Diperbarui!');
    }


    public function destroy(int $id)
    {
        $pengguna = User::find($id);

        if (!$pengguna) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        // Hapus foto
        if ($pengguna->image && Storage::disk('public')->exists($pengguna->image)) {
            Storage::disk('public')->delete($pengguna->image);
        }

        $pengguna->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
}
