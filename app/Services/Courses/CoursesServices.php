<?php

namespace App\Services\Courses;

use App\Models\Courses\CoursesCoursesM;

class CoursesServices
{

    public static function GetAllCourses($limit = 10)
    {
        $courses = CoursesCoursesM::with([
            'instructor' => function($query) {
                $query->select('id', 'name');
            },
            'courseVideo' => function($query) {
                $query->select('id', 'course_id', 'time');
            }
        ])
        ->select('id', 'name', 'desc', 'price', 'delivary_method', 'image', 'instructors_id') 
        ->paginate($limit);
        return $courses;
    }
}



