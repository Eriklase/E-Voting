<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use App\Models\Kandidat;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Show voting report
     */
    public function index()
    {
        $kandidats = Kandidat::withCount('voting')->orderByDesc('voting_count')->get();

        $totalSuara = Voting::count();
        $totalKandidat = Kandidat::count();

        return view('laporan.index', compact('kandidats', 'totalSuara', 'totalKandidat'));
    }

    /**
     * Export report to CSV
     */
    public function exportCsv()
    {
        $kandidats = Kandidat::withCount('voting')->orderByDesc('voting_count')->get();

        $filename = 'laporan_voting_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($kandidats) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Nama Kandidat', 'Total Suara', 'Persentase']);

            $total = $kandidats->sum('voting_count');
            $no = 1;

            foreach ($kandidats as $kandidat) {
                $persentase = $total > 0 ? round(($kandidat->voting_count / $total) * 100, 2) . '%' : '0%';
                fputcsv($file, [$no++, $kandidat->nama_kandidat, $kandidat->voting_count, $persentase]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Reset all voting data
     */
    public function resetVoting()
    {
        return view('laporan.reset');
    }

    /**
     * Confirm reset voting
     */
    public function confirmReset(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (!\Hash::check($request->password, auth()->user()->password)) {
            return back()->with('error', 'Password salah!');
        }

        Voting::truncate();

        return redirect()->route('laporan.index')->with('success', 'Data voting berhasil direset!');
    }
}
