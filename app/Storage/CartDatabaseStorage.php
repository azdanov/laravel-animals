<?php

declare(strict_types=1);

namespace App\Storage;

use App\CartStorage;
use Darryldecode\Cart\CartCollection;

class CartDatabaseStorage
{
    /** @return CartStorage|mixed */
    public function has(string $key)
    {
        return CartStorage::find($key);
    }

    public function get(string $key): CartCollection
    {
        if ($this->has($key)) {
            return new CartCollection(CartStorage::find($key)->cart_data);
        }

        return new CartCollection([]);
    }

    /** @param mixed $value */
    public function put(string $key, $value): void
    {
        $row = CartStorage::find($key);

        if ($row) {
            $row->cart_data = $value;
            $row->save();
        } else {
            CartStorage::create([
                'id' => $key,
                'cart_data' => $value,
            ]);
        }
    }
}
