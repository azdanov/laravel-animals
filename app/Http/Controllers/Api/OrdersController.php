<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;

class OrdersController extends Controller
{
    public function index(): string
    {
        return Order::select(['id', 'name', 'price', 'quantity', 'created_at'])
            ->get()
            ->toJson();
    }
}
