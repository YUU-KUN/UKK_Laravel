<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Siswa as SiswaResource;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateUserRegistration;
use App\Http\Requests\ValidateUserLogin;
use App\User;
use App\Siswa;

use Auth; 

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'loginsiswa', 'registerPetugas', 'registerSiswa', ]]);
    // }

    public function registerPetugas(ValidateUserRegistration $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'petugas',
            'password' => bcrypt($request->password),
        ]); 
        return new UserResource($user); 
    }
    
    public function registerSiswa(Request $request){
        // return 'hlao';
        $siswa = Siswa::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => 'siswa',
            'password' => bcrypt($request->password),
        ]); 
        return new SiswaResource($siswa); 
    }

    public function login(ValidateUserLogin $request){
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return  response()->json([ 
                'errors' => [
                    'msg' => ['Incorrect username or password.']
                ]  
            ], 401);
        }
    
        return response()->json([
            'type' =>'success',
            'message' => 'Logged in.', 
            'token' => $token,
            'user' => auth()->user(),
        ]);
    }

    public function loginSiswa(Request $request){
        $credentials = request(['username', 'password']);
        if (Auth::guard('siswa')->attempt($credentials)) {
            $siswa = Auth::guard('siswa')->user();
            $token = $siswa->createToken('MyApp')->accessToken;
            return response()->json([
                'type' =>'success',
                'message' => 'Logged in.', 
                'token' => $token,
                'user' => $siswa,
            ]);
        }

        return  response()->json([ 
            'errors' => [
                'msg' => ['Incorrect username or password.']
            ]  
        ], 401);
    }
 
    // public function halo()
    // { 
    //    return new UserResource(auth()->user());
    // }

    // public function siswa()
    // { 
    //    return new SiswaResource(auth()->siswa());
    // }

}
