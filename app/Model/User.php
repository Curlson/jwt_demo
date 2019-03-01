<?php

namespace App\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = ['name', 'mobile', 'email', 'password', 'created_at'];
	
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}
	
	public function getJWTCustomClaims()
	{
		return [];
	}
}
