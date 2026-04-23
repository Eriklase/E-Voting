<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use App\Models\Kandidat;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    /**
     * Show voting page with list of kandidat
     */
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Check if already voted
        if ($mahasiswa->hasVoted()) {
            return redirect()->route('voting.hasil')->with('info', 'Anda sudah melakukan voting!');
        }

        $kandidats = Kandidat::all();

        return view('voting.index', compact('kandidats', 'mahasiswa'));
    }

    /**
     * Store voting
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kandidat_id' => 'required|exists:kandidat,id',
        ]);

        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Check if already voted
        if ($mahasiswa->hasVoted()) {
            return redirect()->route('voting.hasil')->with('error', 'Anda sudah melakukan voting!');
        }

        Voting::create([
            'mahasiswa_id' => $mahasiswa->id,
            'kandidat_id' => $validated['kandidat_id'],
        ]);

        return redirect()->route('voting.hasil')->with('success', 'Voting berhasil! Terima kasih telah berpartisipasi.');
    }

    /**
     * Show voting results
     */
    public function hasil()
    {
        $kandidats = Kandidat::withCount('voting')->get();
        $totalSuara = Voting::count();

        return view('voting.hasil', compact('kandidats', 'totalSuara'));
    }
}
