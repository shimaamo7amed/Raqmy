<?php

namespace App\Models\Instructors;

use App\Models\Users\UsersUsersM;
use App\Models\Courses\CoursesCoursesM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstructorsInstructorsM extends Model
{
    protected $table = "users_instructors";
    public $timestamps = true;

     protected $fillable = [
    'code',
    'name_en',
    'name_ar',
    'email',
    'phone',
    'message',
    'linkedIn',
    'experince',
    'cv',
    'password',
    'desc',
    'image',
    'facebook',
    'website',
    ];
    protected $hidden = [
        'id',
    ];
    protected $casts = [
        'desc' => 'array',
    ];
       public function courses()
    {
        return $this->hasMany(CoursesCoursesM::class, 'instructors_id');
    }
    public function user()
{
    return $this->belongsTo(UsersUsersM::class);
}

}
