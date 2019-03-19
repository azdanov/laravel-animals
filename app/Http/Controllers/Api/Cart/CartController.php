<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Cart;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** @throws Exception */
    public function index(Request $request): string
    {
        Cart::session($request->user()->id);

        return Cart::getContent()->toJson();
    }

    /** @throws Exception */
    public function store(Request $request): string
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        Cart::session($request->user()->id);
        Cart::add($data);

        return Cart::getContent()->toJson();
    }

    /** @throws Exception */
    public function update(Request $request, int $item): string
    {
        $data = $request->validate([
            'id' => 'nullable|numeric',
            'name' => 'nullable',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
        ]);
        Cart::session($request->user()->id);
        Cart::update($item, $data);

        return Cart::getContent()->toJson();
    }

    /** @throws Exception */
    public function destroy(Request $request, int $item): string
    {
        Cart::session($request->user()->id);
        Cart::remove($item);

        return Cart::getContent()->toJson();
    }
}
