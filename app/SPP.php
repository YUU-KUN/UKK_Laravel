<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPP extends Model
{
    protected $fillable = ['tahun', 'nominal'];
    protected $primaryKey = 'id_spp';
    protected $table = 'spp';

    public function Siswa() {
        return $this->belongsTo('App\Siswa', 'nisn');
        // return $this->hasMany('App\Siswa', 'nisn');
    }

    public function SPP() {
        // return $this->hasOne('App\Spp', 'id_spp');
        return $this->hasMany('App\Spp', 'id_spp');
    }

    public function Pembayaran() {
        return $this->hasMany('App\Pembayaran', 'id_pembayaran');
        // return $this->hasOne('App\Pembayaran', 'id_spp');
    }
}
