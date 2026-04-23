<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of mahasiswa
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $mahasiswas = Mahasiswa::query();

        if ($search) {
            $mahasiswas = $mahasiswas->where('nim', 'like', "%{$search}%")->orWhere('nama', 'like', "%{$search}%");
        }

        $mahasiswas = $mahasiswas->with('user')->paginate(10);

        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    /**
     * Show the form for creating a new mahasiswa
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created mahasiswa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:mahasiswa',
            'jurusan' => 'required|string',
            'angkatan' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'nim' => $validated['nim'],
            'nama' => $validated['name'],
            'jurusan' => $validated['jurusan'],
            'angkatan' => $validated['angkatan'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified mahasiswa
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified mahasiswa
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jurusan' => 'required|string',
            'angkatan' => 'required|string',
        ]);

        $mahasiswa->update([
            'nama' => $validated['name'],
            'jurusan' => $validated['jurusan'],
            'angkatan' => $validated['angkatan'],
        ]);

        $mahasiswa->user->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    /**
     * Remove the specified mahasiswa
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $userId = $mahasiswa->user_id;
        $mahasiswa->delete();
        User::destroy($userId);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
