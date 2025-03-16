<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;

class courseRatesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "review"=>"string",
            "rates"=>"required|integer|max_digits:5",
            "course_id"=>"required|exists:courses_courses,id",
            "user_id"=>"required|exists:users_users,id",
        ];
    }
}
