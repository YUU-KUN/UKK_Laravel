<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateUserRegistration;
use App\Http\Requests\ValidateUserLogin;
use App\User;
use App\Siswa;
use App\Petugas;

use Auth; 
use Hash; 

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'loginsiswa', 'registerPetugas', 'registerSiswa', ]]);
    // }

    public function registerPetugas(Request $request){
        $petugas = Petugas::create([
            'username' => $request->username,
            'password' => $request->password,
            // 'password' => Hash::make($request->password),
            'nama_petugas' => $request->nama_petugas,
            'level' => 'petugas',
            // 'password' => bcrypt($request->password),
        ]); 
        if ($petugas) {
            return response()->json([
                'status' => 1,
                'message' => 'Berhasil Mendaftarkan Petugas',
                'petugas' => $petugas
            ]);
            # code...
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal mendaftarkan Petugas'
            ]);
        }
        // return new UserResource($user);  
    }
    
    public function registerSiswa(Request $request){
        $siswa = Siswa::create([
            'nis' => null,
            'id_kelas' => null,
            'id_spp' => null,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'password' => bcrypt($request->password),
        ]); 
        if ($siswa) {
            return response()->json([
                'status' => 1,
                'message' => 'Berhasil mendaftarkan Siswa',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal mendaftarkan Siswa',
            ]);
        }
    }

    // public function login(Request $request){
    //     $credentials = request(['username', 'password']);
    //     if (!$token = auth()->attempt($credentials)) {
    //         return  response()->json([ 
    //             'errors' => [
    //                 'msg' => ['Incorrect username or password.']
    //             ]  
    //         ], 401);
    //     }
    
    //     return response()->json([
    //         'type' =>'success',
    //         'message' => 'Logged in.', 
    //         'token' => $token,
    //         'user' => auth()->user(),
    //     ]);
    // }

    public function loginSiswa(Request $request){
        // $credentials = request(['nama', 'password']);
        // if (Auth::guard('siswa')->attempt($credentials)) {
        //     $siswa = Auth::guard('siswa')->user();
        //     $token = $siswa->createToken('MyApp')->accessToken;
        //     return response()->json([
        //         'type' =>'success',
        //         'message' => 'Logged in.', 
        //         'token' => $token,
        //         'user' => $siswa,
        //     ]);
        // }

        // if ($token = auth('web')->attempt($credentials)) {
        //     $siswa = auth('web')->user();
        //     // $token = $siswa->createToken('MyApp')->accessToken;
        //     return response()->json([
        //         'type' =>'success',
        //         'message' => 'Logged in.', 
        //         'token' => $token,
        //         'user' => $siswa,
        //     ]);
        // }

        $siswa = Siswa::where('nama', $request->nama)->first();
        // return $siswa;

        if (Hash::check(request()->password, $siswa->password)) {
            return response()->json([
                'type' =>'success',
                'message' => 'Logged in.', 
                'token' => $siswa->createToken('MyApp')->accessToken,
                'siswa' => $siswa,
            ]);
        }
       

            return response()->json([
                'status' => 0,
                'message' => 'Incorrect Username or Password.', 
            ]);
    }

    public function loginPetugas(Request $request){
        // $credentials = request(['username', 'password']);
        $petugas = Petugas::where('username', $request->username)->where('password', $request->password)->first();
        // return $petugas;

        if ($token = Auth::login($petugas)) {
        // if (Auth::guard('petugas')->attempt($credentials)) {
        // if (Hash::check(request()->password, $petugas->password)) {
            // $petugas = Auth::guard('petugas')->user();
            // $token = $petugas->createToken('MyApp');
            // $token = $petugas->createToken('MyApp')->accessToken;
            return response()->json([
                'type' =>'success',
                'message' => 'Logged in.', 
                'token' => $token,
                'petugas' => $petugas,
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Incorrect Username or Password.', 
        ]);
    }

}
