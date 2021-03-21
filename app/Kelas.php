<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama_kelas', 'kompetensi_keahlian'];
    protected $primaryKey = 'id_kelas';
    protected $table = 'kelas';

    public function Siswa() {
        return $this->hasMany('App\Siswa', 'nisn');
    }
}
