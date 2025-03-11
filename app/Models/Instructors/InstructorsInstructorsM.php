<?php

namespace App\Models\Instructors;

use App\Models\Courses\CoursesCoursesM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstructorsInstructorsM extends Model
{
    protected $table = "users_instructors";
    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'desc',
        'image',
        'facebook',
        'linkedIn',
    ];
        protected $casts = [
        'name' => 'array',
        'desc' => 'array',
    ];

       public function courses()
    {
        return $this->hasMany(CoursesCoursesM::class, 'instructors_id');
    }
}
