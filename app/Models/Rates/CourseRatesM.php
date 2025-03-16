<?php

namespace App\Models\Rates;
use App\Models\Users\UsersUsersM;
use App\Models\Courses\CoursesCoursesM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseRatesM extends Model
{
    protected $table = "courses_rates";
    public $timestamps = true;

    protected $fillable = [
        'review',
        'rates',
        'user_id',
        'course_id',
    ];

    public function courses()
    {
        return $this->belongsTo(CoursesCoursesM::class, 'course_id');
    }
    public function users()
    {
        return $this->belongsTo(UsersUsersM::class, 'user_id');
    }
}
