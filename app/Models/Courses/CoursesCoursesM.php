<?php

namespace App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\CategoriesCategoriesM;
use App\Models\Categories\CategoriesSubCategoriesM;
use App\Models\Instructors\InstructorsInstructorsM;

class CoursesCoursesM extends Model
{
       protected $table = "courses_courses";
    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'desc',
        'price',
        'discount',
        'price_after',
        'goals',
        'status',
        'users',
        'image',
        'delivary_method',
        'instructors_id',
        'category_id',
        'subcategory_id',
        'timeZone',
    ];
     protected $casts = [
        'name' => 'array',
        'desc' => 'array',
        'goals' => 'array',
        'users' => 'array',
    ];
    public function instructor()
    {
        return $this->belongsTo(InstructorsInstructorsM::class, 'instructors_id');
    }
    public function category()
    {
        return $this->belongsTo(CategoriesCategoriesM::class, 'category_id');
    }
    public function subcategory()
{
    return $this->belongsTo(CategoriesSubCategoriesM::class, 'subcategory_id');
}

}
