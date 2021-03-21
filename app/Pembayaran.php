<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['id_petugas', 'nisn', 'tgl_bayar', 'bulan_dibayar', 'tahun_dibayar', 'id_spp' ,'jumlah_bayar'];
    protected $primaryKey = 'id_pembayaran';
    protected $table = 'pembayaran';

    public function Siswa() {
        return $this->belongsTo('App\Siswa', 'nisn');
    }

    public function SPP() {
        return $this->belongsTo('App\Spp', 'id_spp');   
    }

    public function Petugas() {
        return $this->belongsTo('App\Petugas', 'id_petugas');
    }
}
