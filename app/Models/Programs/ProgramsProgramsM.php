<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Model;


class ProgramsProgramsM extends Model
{
    protected $table = "programs_programs";
    public $timestamps = true;

    protected $fillable =
    [
        'code',
        'title',
        'desc',
        'total_price',
        'discount',
        'price_after',
        'goals',
        'courses_hour',
        'courses_number',
        'courses_image',
        'courses_video',
        'career_path',
    ];
    protected $casts =
    [
        'title' => 'array',
        'desc' => 'array',
        'goals' => 'array',
        'career_path' => 'array',
    ];
        protected static function boot()
    {
        parent::boot();

        static::saving(function ($course) {
        $course->price_after = $course->total_price - ($course->total_price * $course->discount / 100);
    });
    }

}

