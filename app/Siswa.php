<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

// class Siswa extends Authenticatable implements JWTSubject
class Siswa extends Authenticatable 
{
    use Notifiable, HasApiTokens;

    protected $fillable = [ 'nis', 'nama', 'id_kelas', 'alamat', 'password', 'no_telp', 'id_spp'];
    protected $primaryKey = 'nisn';
    protected $table = 'siswa';

    
    public function Pembayaran() {
        return $this->hasMany('App\Pembayaran', 'id_pembayaran');
    }
    
    public function Kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
    
    public function SPP() {
        return $this->belongsTo('App\Spp', 'id_spp');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
