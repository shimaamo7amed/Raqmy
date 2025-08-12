<?php
namespace App\Services\Carts;

use App\Models\Carts\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Courses\CoursesCoursesM;

class CartServices
{
    public function addToCart(array $data)
    {
        $user = auth()->user();
        // dd($user);
        $userId = $user?->id;

        $course = CoursesCoursesM::find($data['course_id']);
        if (!$course) {
            throw new \Exception('Course not found', 404);
        }

        return DB::transaction(function () use ($data, $userId, $course) {
            $cart = Cart::where(function ($query) use ($userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                }
            })->first();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => $userId,
                    'status'  => 'pending'
                ]);
            }
            $cartItem = $cart->courseItems()->where('courses_id', $data['course_id'])->first();
            $unitPrice = $course->price;
            if (!$cartItem) {
                $cartItem = $cart->courseItems()->create([
                    'courses_id' => $data['course_id'],
                    'unit_price' => $unitPrice,
                    'total_price'=> $unitPrice,
                ]);
            }

            return [
                'user_id'   => $userId,
                'cart_item' => $cartItem,
            ];
        });
    }

    public function getCart()
    {
        $user = auth()->user();
        $userId = $user?->id;
        $cart = Cart::with(
            'courseItems.course.rates',
        )
        ->where(function ($query) use ($userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            }
        })
        ->where('status', 'pending')
        ->first();
        // dd($cart);
        if (!$cart) {
            return [];
        }

        $cartTotalPrice = $cart->courseItems->sum('total_price');

        return [
            'cart_id'          => $cart->id,
            'user_id'          => $cart->user_id,
            'cart_total_price' => $cartTotalPrice,
            'status'           => $cart->status,
            'items'            => $cart->courseItems->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'course_id'     => $item->courses_id,
                    'price'    => $item->unit_price,
                    'course'        => [
                        'id'          => $item->course->id,
                        'name'        => $item->course->name,
                        'image'       => $item->course->image,
                        'discount_amount' => $item->course->discount.'%',
                        'price_after_discount' => $item->course->price_after,
                        'rating'      => $item->course->rates->avg('rates') ?? 0,
                    ],
                ];
            })->toArray(),
        ];
    }


    public function deleteFromCart($user, $courseId = null): bool
    {
        $cart = Cart::where([
            'user_id' => $user?->id,
            'status' => 'pending',
        ])->first();

        if (!$cart) {
            return false;
        }

        if ($courseId) {
            $deleted = $cart->courseItems()->where('courses_id', $courseId)->delete();
            return $deleted > 0;
        }
        $cart->courseItems()->delete();
        $cart->delete();

        return true;
    }
}