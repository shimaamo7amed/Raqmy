<?php

namespace App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\CategoriesCategoriesM;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

     public function category()
    {
        return $this->belongsTo(CategoriesCategoriesM::class);
    }
}
