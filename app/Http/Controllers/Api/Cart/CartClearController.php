<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Cart;
use Exception;
use Illuminate\Http\Request;

class CartClearController extends Controller
{
    /** @throws Exception */
    public function destroy(Request $request): void
    {
        Cart::session($request->user()->id);

        Cart::clear();
    }
}
