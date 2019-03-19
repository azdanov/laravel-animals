<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Cart;
use Exception;
use Illuminate\Http\Request;

class CartTotalQuantityController extends Controller
{
    /** @throws Exception */
    public function index(Request $request): float
    {
        Cart::session($request->user()->id);

        return Cart::getTotalQuantity();
    }
}
