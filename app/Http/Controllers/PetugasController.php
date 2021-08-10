<?php

namespace App\Http\Controllers;

use App\Petugas;
use Illuminate\Http\Request;
use Hash;
use Auth;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth:petugas', ['except' => [ 'show']]);
    // }

    public function index()
    {
        $petugas = Petugas::get();
        return $petugas;
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
            $input['password'] = $request->password;
            $petugas = Petugas::create($input);
            return $petugas;
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
            $petugas = Petugas::with('Pembayaran')->find($id);
            return $petugas;
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
            $petugas = Petugas::find($id);
            $input = $request->all();
            $input['password'] = $petugas->password;
            $petugas->update($input);
            return $petugas;
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
            $petugas = Petugas::find($id);
            $petugas->delete();
            return 'Data Petugas Berhasil Dihapus';
        }
    }
}
