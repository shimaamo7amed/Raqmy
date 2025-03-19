<?php

namespace App\Models\Courses;

use App\Models\Courses\CoursesCoursesM;

class CoursePromoCodesM extends Model
{
    protected $table = "coures_promocode";
    public $timestamps = true;

    protected $fillable =
    [
        'course_id',
        'promo_code_id',

    ];
    public function courses()
    {
        return $this->belongsToMany(CoursesCoursesM::class, 'course_promo_code');
    }
}

