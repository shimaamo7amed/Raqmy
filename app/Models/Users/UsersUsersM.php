<?php

namespace App\Models\Users;

use App\Models\Rates\CourseRatesM;
use App\Models\Countries\CountriesCountriesM;
use App\Models\Countries\CountriesGovernmentM;
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
        'country_id',
        'government_id',
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
    public function getLocationAttribute($value)
    {
        $location = json_decode($value, true);
        return $location ? $location['government_name'] . ',' . $location['country_name'] : null;
    }
    public function getCountryAttribute($value)
    {
    $country = json_decode($value, true);
    return $country ? $country['country_name'] : null;
    }



    public function country()
    {
        return $this->belongsTo(CountriesCountriesM::class, 'country_id');
    }

    public function government()
    {
        return $this->belongsTo(CountriesGovernmentM::class, 'government_id');
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
}
