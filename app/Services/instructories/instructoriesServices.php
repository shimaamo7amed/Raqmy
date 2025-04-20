<?php

namespace App\Services\instructories;
use App\Models\Users\UsersUsersM;

class instructoriesServices
{

    public static function GetAll($limit=10)
    {
        $query = UsersUsersM::where(['role_id'=>'2'])
        ->select('id','code','name_en','name_ar','image','desc');
        return $query->paginate($limit);
    }
    public static function GetByCode($code)
    {
        $instructor = UsersUsersM::with('courses')
        ->where(['code'=> $code])
        ->select('id','code','name_en','name_ar','email','image','desc','linkedIn','facebook')->first();
        // dd($instructor);
        if ($instructor) {
            return $instructor;
        }else {
            return null;
        }
    }
}


