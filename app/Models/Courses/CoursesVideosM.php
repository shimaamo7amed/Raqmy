<?php

namespace App\Models\Courses;
use App\Models\Courses\CoursesCoursesM;
use App\Models\Courses\CoursesModulesM;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\CategoriesCategoriesM;
use App\Models\Categories\CategoriesSubCategoriesM;
use App\Models\Instructors\InstructorsInstructorsM;

class CoursesVideosM extends Model
{
       protected $table = "courses_course_videos";
    public $timestamps = true;

    protected $fillable = [
        'code',
        'video',
        'time',
        'course_id',
    ];
    public function course()
    {
        return $this->belongsTo(CoursesCoursesM::class, 'course_id');
    }
}
