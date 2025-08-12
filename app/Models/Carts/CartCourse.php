<?php


namespace App\Models\Carts;

use App\Models\Carts\Cart;
use App\Models\Courses\CoursesCoursesM;
use Illuminate\Database\Eloquent\Model;

class CartCourse extends Model
{
    protected $table = 'cart_courses';

    protected $fillable = [
        'cart_id',
        'courses_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function course()
    {
        return $this->belongsTo(CoursesCoursesM::class, 'courses_id');
    }
}
