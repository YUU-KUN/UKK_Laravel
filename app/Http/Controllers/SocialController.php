<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Hash;
use Auth;
use App\Petugas;

class SocialController extends Controller
{
    public function google() {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect() {
        try {
            $user = Socialite::driver('google')->user();
            dd($user);

            $findUser = Petugas::where('google_id', $user->id)->first();
            if ($findUser) {
                // Auth::login($user);
                Auth::guard('admin')->login($user);
                return 'Berhasil Login. Selamat Datang '. $user->name;

                return response()->json([
                    'status' => 1,
                    'message' => 'Berhasil Login. Selamat Datang ' . $user->name
                ]);
            } else {
                $newUser = Petugas::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::guard('admin')->login($newUser);
                // Auth::login($newUser);
                return response()->json([
                    'status' => 1,
                    'message' => 'Berhasil Login. Selamat Datang ' . $newUser->name
                ]);
            }
        } catch (Throwable $e) {
            return $e->getMesage();
        }
    }


    public function github() {
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(Request $request) {
        try {
            $user = Socialite::driver('github')->user();
            $findUser = Petugas::where('github_id', $user->id)->first();
            if ($findUser) {
                Auth::login($user);
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 1,
                        'message' => 'Berhasil Login. Selamat Datang ' . $user->nickname,
                        'user' => $user
                    ]);
                } else {
                    return 'Berhasil Login. Selamat Datang ' . $user->nickname;
                }
            } else {
                $newUser = Petugas::create([
                    'username' => $user->nickname,
                    'email' => $user->email,
                    'nama_petugas' => $user->name,
                    'level' => 'petugas',
                    'github_id' => $user->id,
                    'password' => Hash::make('123456dummy')
                ]);
                Auth::login($newUser);
                // if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 1,
                        'message' => 'Berhasil Login. Selamat Datang ' . $user->nickname,
                        'user' => $user
                    ]);
                // } else {
                //     return redirect('http://localhost:8080/login');
                //     // return 'Berhasil Login. Selamat Datang ' . $user->nickname;
                // }
            }
        } catch (Throwable $e) {
            return $e->getMesage();
        }
    }
}
