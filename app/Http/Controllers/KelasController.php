<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil Mendapatkan Data Kelas',
            'data' => $kelas
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
        $kelas = new Kelas([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);
        // $input = $request->all();
        // $kelas = Kelas::create($input);
        $kelas->save();

        if ($kelas) {
            return response()->json([
                'status' => 200,
                'message' => 'Sukses Menambahkan data kelas baru',
                'data' => $kelas
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Terdapat Kesalahan',
            ]);
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
        $kelas = Kelas::find($id);
        
        if ($kelas) {
            return response()->json([
                'status' => 200,
                'message' => 'Sukses Mendapatkan data kelas',
                'data' => $kelas
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Kelas Tidak Tersedia',
            ]);
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
        $kelas = Kelas::find($id);
        $input['nama_kelas'] = $request->input('nama_kelas');
        $input['kompetensi_keahlian'] = $request->input('kompetensi_keahlian');
        $kelas->update($input);
		$kelas->save();

        if ($kelas) {
            return response()->json([
                'status' => 200,
                // 'message' => 'Sukses mengupdate data kelas',
                'message' => 'Sukses mengupdate data kelas dengan id '.$id,
                'data' => $kelas,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                // 'message' => 'Gagal mengupdate data kelas',
                'message' => 'Gagal mengupdate data kelas dengan id '.$id,
            ]);
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
        $kelas = Kelas::find($id);
        $kelas->delete();

        return response()->json([
            'status' => 200,
            // 'message' => 'Sukses mengupdate data kelas',
            'message' => 'Sukses menghapus data kelas dengan id '.$id
        ]);
    }
}
