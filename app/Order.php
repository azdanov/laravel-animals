<?php

declare(strict_types=1);

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Order.
 *
 * @property int $id
 * @property int $pet_id
 * @property string $name
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereName($value)
 * @method static Builder|Order wherePetId($value)
 * @method static Builder|Order whereQuantity($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $user_id
 * @property float $price
 * @method static Builder|Order wherePrice($value)
 * @method static Builder|Order whereUserId($value)
 */
class Order extends Model
{
    /** @var array<string> */
    protected $guarded = [];
}
