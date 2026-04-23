<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
    /**
     * Display a listing of kandidat
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $kandidats = Kandidat::query();

        if ($search) {
            $kandidats = $kandidats->where('nama_kandidat', 'like', "%{$search}%");
        }

        $kandidats = $kandidats->withCount('voting')->paginate(10);

        return view('kandidat.index', compact('kandidats', 'search'));
    }

    /**
     * Show the form for creating a new kandidat
     */
    public function create()
    {
        return view('kandidat.create');
    }

    /**
     * Store a newly created kandidat
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kandidat', 'public');
        }

        Kandidat::create([
            'nama_kandidat' => $validated['nama_kandidat'],
            'visi' => $validated['visi'],
            'misi' => $validated['misi'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('kandidat.index')->with('success', 'Kandidat berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified kandidat
     */
    public function edit($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        return view('kandidat.edit', compact('kandidat'));
    }

    /**
     * Update the specified kandidat
     */
    public function update(Request $request, $id)
    {
        $kandidat = Kandidat::findOrFail($id);

        $validated = $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($kandidat->foto) {
                Storage::disk('public')->delete($kandidat->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kandidat', 'public');
        }

        $kandidat->update($validated);

        return redirect()->route('kandidat.index')->with('success', 'Kandidat berhasil diperbarui!');
    }

    /**
     * Remove the specified kandidat
     */
    public function destroy($id)
    {
        $kandidat = Kandidat::findOrFail($id);

        if ($kandidat->foto) {
            Storage::disk('public')->delete($kandidat->foto);
        }

        $kandidat->delete();

        return redirect()->route('kandidat.index')->with('success', 'Kandidat berhasil dihapus!');
    }
}
