<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Order;
use Braintree\Gateway;
use Carbon\Carbon;
use Cart;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function array_diff_key;
use function array_map;
use function response;

class CartPaymentController extends Controller
{
    /** @var Gateway */
    private $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /** @throws Exception */
    public function store(Request $request): JsonResponse
    {
        $valid = $request->validate(['nonce' => 'required']);
        Cart::session($request->user()->id);

        $result = $this->gateway->transaction()->sale([
            'amount' => Cart::getTotal(),
            'paymentMethodNonce' => $valid['nonce'],
            'options' => ['submitForSettlement' => true],
        ]);

        if ($result->success === false) {
            foreach ($result->errors->deepAll() as $error) {
                Log::critical('Braintree (' . $error->code . '): ' . $error->message);
            }

            return response()->json(
                ['error' => 'A problem has occurred during payment. Please contact us for assistance.']
            );
        }

        $cart = Cart::getContent()->toArray();

        Order::insert(array_map(static function ($item) use ($request) {
            $item['user_id'] = $request->user()->id;
            $item['pet_id'] = $item['id'];
            $item['created_at'] = Carbon::now();
            $item['updated_at'] = Carbon::now();

            return array_diff_key($item, [
                'attributes' => [],
                'conditions' => [],
                'id' => '',
            ]);
        }, $cart));

        Cart::clear();

        return response()->json(['message' => 'Payment successfully sent.']);
    }
}
