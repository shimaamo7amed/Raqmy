<?php

namespace App\Models\Users;

use App\Models\Events\EventsEventsM;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersUsersM extends Authenticatable  implements JWTSubject
{
    public $timestamps = true;
    protected $table = "users_users";
    protected $fillable = [
        'code',
        'name',
        'user_name',
        'email',
        'password',
        'phone',
        'otp',
        'gender',
        'country',
        'bio',
        'location',
        'image',
        'social_id',
        'social_type',
        'jwt_token',
    ];
    protected $hidden = [
        'id',
        'otp',
        'password',
    ];
    
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
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
