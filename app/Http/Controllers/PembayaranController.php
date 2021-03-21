<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use Illuminate\Http\Request;
use Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $pembayaran = Pembayaran::create($request->all());
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
        $pembayaran->update($request->all());
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
        $topup = Topup::where('id', $request->topup)->first();
        $student = Student::find($topup->student_id);
        // return view('financeAdmin.cashout.invoice', compact('topup', 'student')); //buat ngeliat preview
        $pdf = PDF::loadView('laporan', compact('topup', 'student'));
        return $pdf->stream("Invoice Quki.pdf");
        // return $pdf->stream("invoice cashout quki.pdf");   
    }
}
