<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kandidat;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function adminDashboard()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalKandidat = Kandidat::count();
        $totalSuara = Voting::count();

        $kandidats = Kandidat::withCount('voting')->get();

        return view('dashboard.admin', compact('totalMahasiswa', 'totalKandidat', 'totalSuara', 'kandidats'));
    }

    /**
     * Show mahasiswa dashboard
     */
    public function mahasiswaDashboard()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $hasVoted = $mahasiswa->hasVoted();
        $totalKandidat = Kandidat::count();
        $totalSuara = Voting::count();

        $kandidats = Kandidat::withCount('voting')->get();

        return view('dashboard.mahasiswa', compact('mahasiswa', 'hasVoted', 'totalKandidat', 'totalSuara', 'kandidats'));
    }
}
