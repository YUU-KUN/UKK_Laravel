<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Passport\HasApiTokens;

// class Siswa extends Authenticatable implements JWTSubject
class Siswa extends Authenticatable 
{
    use Notifiable, HasApiTokens;
    // protected $table = 'siswa';

    protected $fillable = [
        'name', 'username', 'role', 'password', 
    ];

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

    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }
}
