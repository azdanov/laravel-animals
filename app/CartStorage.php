<?php

declare(strict_types=1);

namespace App;

use Darryldecode\Cart\CartCollection;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use function base64_decode;
use function base64_encode;
use function serialize;
use function unserialize;

/**
 * App\CartStorage.
 *
 * @property int $id
 * @property mixed $cart_data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CartStorage newModelQuery()
 * @method static Builder|CartStorage newQuery()
 * @method static Builder|CartStorage query()
 * @method static Builder|CartStorage whereCartData($value)
 * @method static Builder|CartStorage whereCreatedAt($value)
 * @method static Builder|CartStorage whereId($value)
 * @method static Builder|CartStorage whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CartStorage extends Model
{
    /** @var array<string> */
    protected $fillable = ['id', 'cart_data'];
    /** @var string */
    protected $table = 'cart_storage';

    /** @param CartCollection|mixed[] $value */
    public function setCartDataAttribute($value): void
    {
        $this->attributes['cart_data'] = base64_encode(serialize($value));
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function getCartDataAttribute($value)
    {
        return unserialize(base64_decode($value, true));
    }
}
