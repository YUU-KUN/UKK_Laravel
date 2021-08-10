<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:admin-api, petugas-api');
    // }

    public function index()
    {      
        $siswa = Siswa::with('Kelas')->get();
        // return $siswa->successResponse($siswa, 'Berhasil Mendapatkan data Siswa');
        return response()->json([
            'success' => true,
            'message' => 'Berhasil Mendapatkan data Siswa',
            'data' => $siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->level == 'admin') {
            $input = $request->all(); 
            $input['password'] = bcrypt($request->password);
            $siswa = Siswa::create($input);
            $siswa->save();
            return $siswa;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->level == 'admin') {
            $siswa = Siswa::with('Kelas')->find($id);
            return $siswa;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->level == 'admin') {
            $input = $request->all();
            $siswa = Siswa::find($id);
            $siswa->update($input);
            return $siswa;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->level == 'admin') {
            $siswa = Siswa::find($id)->delete();
            // $siswa->pembayaran()->delete();
            // $siswa->Spp->delete();
            // $siswa->each->delete();
            return 'Berhasil Menghapus data Siswa';
        }
    }
}
