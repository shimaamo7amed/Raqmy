<?php

namespace App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesSubCategoriesM extends Model
{
    protected $table = "categories_subCategories";
    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'category_id'
    ];
        protected $casts = [
        'name' => 'array',
    ];
}
