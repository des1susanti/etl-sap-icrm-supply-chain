<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // Tambahkan ini untuk validasi password yang aman

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.index')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    // ==== TAMBAHKAN FUNGSI BARU INI ====
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required', 'current_password'], // Validasi: Password lama harus benar
            'password'         => ['required', 'string', 'min:8', 'confirmed'], // Validasi: Password baru minimal 8 karakter & cocok dengan input konfirmasi
        ]);

        // Update password yang sudah di-hash otomatis ke database
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.index')->with('success', 'Password Anda berhasil diperbarui!');
    }

    // ==== REVISI TAMBAHAN: FUNGSI UNTUK UPDATE AVATAR ====
    public function updateAvatar(Request $request)
    {
        $user = auth()->user();

        // Validasi file gambar yang diunggah
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            // Simpan file ke dalam folder 'public/avatars'
            $path = $file->store('avatars', 'public');

            // Hapus file avatar lama jika ada (opsional, untuk menghemat space)
            if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
                \Storage::disk('public')->delete($user->avatar);
            }

            // Update nama file/path di database (asumsi nama kolomnya adalah 'avatar')
            $user->update([
                'avatar' => $path,
            ]);

            return redirect()->route('profile.index')->with('success', 'Foto profil berhasil diperbarui!');
        }

        return redirect()->route('profile.index')->with('error', 'Gagal memperbarui foto profil.');
    }
}