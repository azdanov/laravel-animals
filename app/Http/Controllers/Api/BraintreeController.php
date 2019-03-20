<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Illuminate\Http\JsonResponse;

class BraintreeController extends Controller
{
    /** @var Gateway */
    private $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'token' => $this->gateway->clientToken()->generate(),
        ]);
    }
}
