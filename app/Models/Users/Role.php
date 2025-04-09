<?php

namespace App\Models\Users;

use App\Models\Rates\CourseRatesM;
use App\Models\Countries\CountriesCountriesM;
use App\Models\Countries\CountriesGovernmentM;
use App\Models\Instructors\InstructorsInstructorsM;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable 
{
    public $timestamps = true;
    protected $table = "roles";

    protected $fillable =
    [
        'name'
    ];

    protected $hidden = [
        'id',
    ];
}
