<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use Illuminate\Http\Request;
use Auth;
use App\Kelas;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  public function __construct()
    // {
    //     $this->middleware('auth:admin-api', ['except' => ['laporan', 'getPembayaranSiswa']]);
    //     $this->middleware('auth:petugas-api', ['except' => ['laporan', 'getPembayaranSiswa']]);
    // }

    public function index()
    {
        $pembayaran = Pembayaran::with('Siswa', 'Petugas', 'SPP')->get();
        return $pembayaran;
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
        $input = $request->all();
        $input['id_petugas'] = Auth::user()->id_petugas;
        $pembayaran = Pembayaran::create($input);
        return $pembayaran;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $pembayaran = Pembayaran::with('Siswa', 'Petugas', 'SPP')->find($id);
        return $pembayaran;
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
        $pembayaran = Pembayaran::find($id);
        $input = $request->all();
        $request->tgl_bayar ? $input['tgl_bayar'] = $request->tgl_bayar : $input['tgl_bayar'] = $pembayaran->tgl_bayar;
        $request->bulan_dibayar ? $input['bulan_dibayar'] = $request->bulan_dibayar : $input['bulan_dibayar'] = $pembayaran->bulan_dibayar;
        $request->tgl_bayar ? $input['tgl_bayar'] = $request->tgl_bayar : $input['tgl_bayar'] = $pembayaran->tgl_bayar;
        $request->tahun_dibayar ? $input['tahun_dibayar'] = $request->tahun_dibayar : $input['tahun_dibayar'] = $pembayaran->tahun_dibayar;
        $pembayaran->update($input);
        return $pembayaran;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
        return 'Pembayaran Berhasil Dihapus!';
    }

    public function getPembayaranSiswa() {
        $pembayaran = Pembayaran::where('nisn', Auth::user()->nisn)->with('petugas')->get();
        return response()->json([
            'status' => 1,
            'message' => 'Berhasil Mendapatkan data Pembayaran Siswa',
            'data' => $pembayaran
        ]);
    }

    public function getDetailPembayaranSiswa($id) {
        $detailPembayaran = Pembayaran::where('nisn', Auth::user()->nisn)->where('id_pembayaran', $id)->with('petugas', 'spp', 'siswa')->first();
        return response()->json([
            'status' => 1,
            'message' => 'Berhasil Mendapatkan detail data Pembayaran Siswa',
            'data' => $detailPembayaran
        ]);
    }

    public function laporan(Request $request)
    {   
        $pembayaran = Pembayaran::where('id_pembayaran', $request->id_pembayaran)->with('petugas', 'spp', 'siswa')->first();
        $kelas = Kelas::where('id_kelas', $pembayaran->siswa->id_kelas)->first();
        if ($kelas) {
            $pembayaran['kelas'] = $kelas;
        }
        return response()->json([
            'status' => 1,
            'message' => 'Berhasil Generate Invoice Payment',
            'data' => $pembayaran
        ]);
    }
}
