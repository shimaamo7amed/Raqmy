<?php

namespace App\Services\Courses;

use App\Models\Rates\CourseRatesM;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Courses\CoursesCoursesM;
use App\Services\system\SystemApiResponseServices;

class CoursesServices
{
    public static function GetAllCourses($limit = 10)
    {
        $courses = QueryBuilder::for(CoursesCoursesM::class)
        ->allowedFilters([
            'status',
            'delivary_method',
            AllowedFilter::callback('filter_by_category', function ($query, $value) {
            $query->whereHas('category', function ($q) use ($value) {
            $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", ["%$value%"])
            ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", ["%$value%"]);
            });
        }),
        ])
        ->allowedSorts(["id"])
        ->with([
            'category:id,name',
            'instructor:id,name',
            'courseVideo:id,course_id,time',
            'rates:id,course_id,user_id,rates',
        ])
        ->select('id', 'code', 'name', 'desc', 'price', 'delivary_method', 'image', 'instructors_id', 'category_id')
        ->paginate($limit);
        if ($courses->isEmpty()) {
            return SystemApiResponseServices::ReturnSuccess(
                [],
                __('no_courses_found'),
                null
            );
        }

        return $courses;
    }
    public static function GetByCode($code)
    {
        $course =CoursesCoursesM::with([
                "instructor",
                "modules",
                "modules.moduleItem",
                "courseVideo",
                "rates"
            ])->where("code", $code)->first();

        return $course ?: null;
    }

    public static function  CourseRates(array $array)
    {
        // dd($array);
        $existingRate = CourseRatesM::where('course_id', $array['course_id'])
        ->where('user_id', $array['user_id'])
        ->first();

        if ($existingRate)
        {
            $existingRate->update(['rates' => $array['rates']]);
            return $existingRate;
        } else
        {
            $courseRates = CourseRatesM::create($array);
            return $courseRates;
        }


    }


    public static function search(array $array, $limit = 10)
    {
        // dd($array['search']);
        $courses = CoursesCoursesM::with([
            'category:id,name',
            'instructor:id,name',
            'courseVideo:id,course_id,time',
            'rates:id,course_id,user_id,rates',
        ])
        ->where('name', 'like', '%' . $array['search'] . '%')
        ->select('id', 'code', 'name', 'desc', 'price', 'delivary_method', 'image', 'instructors_id', 'category_id')
        ->paginate($limit);
        if ($courses->isEmpty()) {
        return [];
        }

      return $courses;
    }

}



