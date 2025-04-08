<?php

namespace App\Models\Users;

use App\Models\Rates\CourseRatesM;
use App\Models\Countries\CountriesCountriesM;
use App\Models\Countries\CountriesGovernmentM;
use App\Models\Instructors\InstructorsInstructorsM;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersUsersM extends Authenticatable implements JWTSubject
{
    public $timestamps = true;
    protected $table = "users_users";

    protected $fillable =
    [
        'code',
        'name',
        'userName',
        'email',
        'password',
        'phone',
        'otp',
        'gender',
        'country',
        'government',
        'bio',
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
   
    public function rates()
    {
        return $this->HasMany(CourseRatesM::class, 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function instructor()
    {
    return $this->hasOne(InstructorsInstructorsM::class);
    }



    // public function country()
    // {
    //     return $this->belongsTo(CountriesCountriesM::class, 'country_id');
    // }

    // public function government()
    // {
    //     return $this->belongsTo(CountriesGovernmentM::class, 'government_id');
    // }
}
