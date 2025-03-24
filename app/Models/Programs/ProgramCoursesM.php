<?php

namespace App\Models\Courses;
use App\Models\Rates\CourseRatesM;
use App\Models\Courses\PromoCodesM;
use App\Models\Courses\CoursesVideosM;
use App\Models\Courses\CoursesModulesM;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\CategoriesCategoriesM;
use App\Models\Categories\CategoriesSubCategoriesM;
use App\Models\Instructors\InstructorsInstructorsM;

class CoursesCoursesM extends Model
{
    protected $table = "ProgramCoursesM";
    public $timestamps = true;

    protected $fillable =
    [
    
        'course_id',
        'program_id',

    ];
}

