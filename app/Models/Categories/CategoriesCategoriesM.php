<?php

namespace App\Models\Categories;
use App\Models\Courses\CoursesCoursesM;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\CategoriesSubCategoriesM;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriesCategoriesM extends Model
{
    protected $table = "categories_categories";
    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
    ];
        protected $casts = [
        'name' => 'array',
    ];
     public function subCategories()
    {
        return $this->hasMany(CategoriesSubCategoriesM::class,'category_id');
    }
     public function courses()
    {
        return $this->hasMany(CoursesCoursesM::class, 'category_id');
    }
}
