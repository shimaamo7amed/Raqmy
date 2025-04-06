<?php

namespace App\Models\Courses;
use App\Models\Courses\CoursesCoursesM;
use App\Models\Courses\CoursesModulesM;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courses\CoursesModuleItemsM;
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
        // 'title',
        'module_item_id',
        'course_id',
    ];
    // protected $casts =
    // [
    // 'title' => 'array',
    // 'desc' => 'array',
    // ];
    public function course()
    {
        return $this->belongsTo(CoursesCoursesM::class, 'course_id');
    }
    public function moduleItem()
   {
    return $this->belongsTo(CoursesModuleItemsM::class, 'module_item_id');
   }
}
