<?php

namespace App\Models\Courses;
use App\Models\Courses\CoursesCoursesM;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\CategoriesCategoriesM;
use App\Models\Categories\CategoriesSubCategoriesM;
use App\Models\Instructors\InstructorsInstructorsM;

class CoursesModulesM extends Model
{
    protected $table = "courses_modules";
    public $timestamps = true;

    protected $fillable = [
        'code',
        'title',
        'course_id',
    ];
    protected $casts = [
        'title' => 'array',
    ];
    public function course()
    {
        return $this->belongsTo(CoursesCoursesM::class, 'course_id');
    }

}
