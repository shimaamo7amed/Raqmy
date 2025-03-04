<?php

namespace App\Services\categories;

use App\Models\Categories\CategoriesCategoriesM;

class CategoriesServices
{

    public static function GetAll($limit=10)
    {
        $query = CategoriesCategoriesM::query();
        return $query->paginate($limit);
    }
}


