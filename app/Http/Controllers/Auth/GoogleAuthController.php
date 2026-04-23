<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Mengarahkan pengguna ke halaman login Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Menangani callback dari Google.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cek apakah user dengan email atau google_id tersebut sudah ada
            $user = User::where('email', $googleUser->getEmail())
                        ->orWhere('google_id', $googleUser->getId())
                        ->first();

            if ($user) {
                // Jika user sudah ada, update google_id nya jika belum ada
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
                
                Auth::login($user);
            } else {
                // Jika user belum ada, buat akun baru dengan role mahasiswa
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role' => 'mahasiswa',
                    // Password tidak diisi karena login via Google
                ]);

                Auth::login($newUser);
            }

            // Arahkan sesuai role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('dashboard.admin'));
            } else {
                return redirect()->intended(route('dashboard.mahasiswa'));
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login menggunakan Google. Silakan coba lagi. (' . $e->getMessage() . ')');
        }
    }
}
