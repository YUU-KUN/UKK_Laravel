<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Petugas extends Authenticatable implements JWTSubject
// class Petugas extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $primaryKey = 'id_petugas';
    protected $table = 'petugas';
    protected $fillable = ['username', 'password', 'nama_petugas', 'level', 'google_id', 'github_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Pembayaran() {
        return $this->hasMany('App\Pembayaran', 'id_petugas');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    
}
