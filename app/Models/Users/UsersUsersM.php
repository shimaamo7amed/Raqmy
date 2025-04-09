<?php

namespace App\Models\Users;

use App\Models\Users\Role;
use App\Models\Rates\CourseRatesM;
use App\Models\Courses\CoursesCoursesM;
use App\Models\Countries\CountriesCountriesM;
use App\Models\Countries\CountriesGovernmentM;
use App\Models\Instructors\InstructorsInstructorsM;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersUsersM extends Authenticatable implements JWTSubject
{
    public $timestamps = true;
    protected $table = "users_users";

   protected $fillable = [
        'code', 'name', 'email', 'userName', 'phone', 'password',
        'gender', 'country', 'bio', 'otp', 'government', 'image',
        'social_id', 'social_type', 'jwt_token',
        'name_en', 'name_ar', 'experince', 'linkedIn', 'cv', 'desc',
        'facebook', 'website', 'role_id'
    ];

    protected $hidden = [
        'id',
        'otp',
        'password',
        'jwt_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
     protected $casts =
    [
        'desc' => 'array',
    ];
       public function courses()
    {
        return $this->hasMany(CoursesCoursesM::class, 'instructors_id');
    }
     public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
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
