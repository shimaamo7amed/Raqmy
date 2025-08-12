<?php


namespace App\Models\Carts;

use App\Models\Carts\CartCourse;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = true;

    protected $table = 'carts_carts';

    protected $fillable = [
        'user_id',
        'status',
        'coupon_code',
        'discount_amount',
        'total_amount',
    ];

    public function user()
    {
        return $this->belongsTo(UsersUsersM::class, 'user_id');
    }
    public function courseItems()
    {
        return $this->hasMany(CartCourse::class);
    }
}
