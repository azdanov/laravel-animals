<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Cart;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(): Renderable
    {
        return view('cart');
    }

    /** @throws Exception */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        Cart::session($request->user()->id);
        Cart::add($data);

        return redirect()->back();
    }
}
