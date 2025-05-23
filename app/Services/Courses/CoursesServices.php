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
            'subcategory:id,name',
            'instructor:id,name_en,name_ar',
            'courseVideo.moduleItem',
            'rates:id,course_id,user_id,rates',
        ])
        ->select('id', 'code', 'name', 'desc', 'price','price_after', 'delivary_method', 'status','image','main_video', 'video_time', 'instructors_id', 'category_id','subcategory_id')
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
                "instructor:id,name_en,name_ar,desc,image,facebook,linkedIn",
                "modules",
                "modules.moduleItem",
                "courseVideo.moduleItem",
                "rates"
            ])->where("code", $code)->first();

        return $course ?: null;
    }

    public static function  CourseRates(array $array)
    {
        // dd($array);
        $existingRate = CourseRatesM::where('course_id', $array['course_id'])
        ->where('user_id', auth()->user()->id)
        ->first();
        if ($existingRate)
        {
            $existingRate->update([
            'rates' => $array['rates'] ?? null,
            'review' => $array['review'] ?? null,
        ]);
        return $existingRate;
        } else
        {
            $courseRates = CourseRatesM::create($array);
            return $courseRates;
        }


    }

    public static function  UpdateCourseRates($id,array $array)
    {
       // dd($array);
        $courseRates = CourseRatesM::findorFail($id);
        // dd($courseRates['course_id']);
        // $user=auth()->user()->id;
        // dd($user);
        if ($courseRates['course_id']!=auth()->user()->id) {
            throw new \Exception('Unauthorized');
        }
        if ($courseRates['course_id'] == $array['course_id']) {
        $courseRates->update([
            'rates' => $array['rates'] ?? null,
            'review' => $array['review'] ?? null,
        ]);
        return $courseRates;
        }
        return null;

    }

    public static function search(array $array, $limit = 10)
    {
        // dd($array['search']);
        // $courses = CoursesCoursesM::with([
        //     'category:id,name',
        //     'subcategory:id,name',
        //     'instructor:id,name_en,name_ar',
        //     "courseVideo.moduleItem",
        //     'rates:id,course_id,user_id,rates',
        // ])
        // ->where('name', 'like', '%' . $array['search'] . '%')
        // ->select('id', 'code', 'name', 'desc', 'price', 'delivary_method', 'image', 'main_video','video_time','instructors_id', 'category_id','subcategory_id')
        // ->paginate($limit);
        $searchTerm = strtolower($array['search']);
        $courses = CoursesCoursesM::whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.en'))) LIKE ?", ['%' . $searchTerm . '%'])
            ->orWhereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar'))) LIKE ?", ['%' . $searchTerm . '%'])
            ->select('id', 'code', 'name', 'image')
            ->get();

        if ($courses->isEmpty()) {
            return [];
        }

    return $courses;
    }



}