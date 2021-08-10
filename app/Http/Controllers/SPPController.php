<?php

namespace App\Http\Controllers;

use App\SPP;
use Illuminate\Http\Request;
use Auth;
class SPPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = SPP::get();
        return $spp;
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
            $spp = SPP::create($request->all());
            return $spp;
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
            $spp = SPP::find($id);
            return $spp;
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
            $spp = SPP::find($id);
            $spp->update($request->all());
            return $spp;
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
            $spp = SPP::find($id);
            $spp->delete();
            return 'Berhasil Menghapus SPP';
        }
    }
}
