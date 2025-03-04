<?php

namespace App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
