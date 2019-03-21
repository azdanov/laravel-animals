<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    public function index(Request $request): string
    {
        /** @var Order[]|Collection $orders */
        $orders = $request
            ->user()
            ->orders()
            ->select(
                ['id', 'name', 'price', 'quantity', 'created_at']
            )->get();

        return $orders->toJson();
    }
}
