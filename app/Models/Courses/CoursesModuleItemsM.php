<?php

namespace App\Models\Courses;
use App\Models\Courses\CoursesCoursesM;
use App\Models\Courses\CoursesModulesM;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\CategoriesCategoriesM;
use App\Models\Categories\CategoriesSubCategoriesM;
use App\Models\Instructors\InstructorsInstructorsM;

class CoursesModuleItemsM extends Model
{
    protected $table = "courses_module_items";
    public $timestamps = true;

    protected $fillable = [
        'code',
        'content',
        'module_id',
    ];
    protected $casts = [
        'content' => 'array',
    ];
    public function module()
    {
        return $this->belongsTo(CoursesModulesM::class, 'module_id');
    }

}
