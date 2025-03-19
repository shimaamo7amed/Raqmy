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
    protected $table = "courses_courses";
    public $timestamps = true;

    protected $fillable =
    [
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
    protected $casts =
    [
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
    public function modules()
    {
        return $this->hasMany(CoursesModulesM::class, 'course_id');
    }

    public function courseVideo()
    {
        return $this->hasMany(CoursesVideosM::class, 'course_id');
    }
    public function rates()
    {
        return $this->HasMany(CourseRatesM::class, 'course_id');
    }
    public function getDiscountedPriceAttribute()
    {
        return $this->price - ($this->price * $this->discount / 100);
    }
    public function promoCodes()
    {
        return $this->belongsToMany(PromoCodesM::class, 'course_promo_code');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($course) {
        $course->price_after = $course->price - ($course->price * $course->discount / 100);
    });
    }

}

