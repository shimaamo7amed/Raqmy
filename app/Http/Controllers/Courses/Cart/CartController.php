<?php


namespace App\Http\Controllers\Courses\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Carts\CartServices;
use App\Services\system\SystemApiResponseServices;
use App\Http\Requests\Courses\Cart\AddToCartRequest;

Class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartServices $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(AddToCartRequest $request)
    {
            $cart = $this->cartService->addToCart($request->validated());
            if ($cart) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["cart" => $cart],
                    __("Cart added successfully"),
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("Failed to add to cart"),
                    null
                );
            }

    }
    public function getCart()
    {
        $cart = $this->cartService->getCart();
        if ($cart) {
            return SystemApiResponseServices::ReturnSuccess(
                ["cart" => $cart],
                __("Cart retrieved successfully"),
                null
            );
        } else {
            return SystemApiResponseServices::ReturnFailed(
                [],
                __("No cart found"),
                null
            );
        }
    }

    public function removeFromCart($course_id = null)
    {
        $user = auth()->user();
        $result = $this->cartService->deleteFromCart($user, $course_id);

        if (!$result) {
            return SystemApiResponseServices::ReturnFailed(
                [],
                __("Cart or course not found"),
                null
            );
        }

        return SystemApiResponseServices::ReturnSuccess(
            [],
            __("Deleted successfully"),
            null
        );
    }

}