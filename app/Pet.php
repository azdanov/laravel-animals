<?php

declare(strict_types=1);

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Pet.
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Pet newModelQuery()
 * @method static Builder|Pet newQuery()
 * @method static Builder|Pet query()
 * @method static Builder|Pet whereCreatedAt($value)
 * @method static Builder|Pet whereId($value)
 * @method static Builder|Pet whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image
 * @property int $category_id
 * @method static Builder|Pet whereCategoryId($value)
 * @method static Builder|Pet whereDescription($value)
 * @method static Builder|Pet whereImage($value)
 * @method static Builder|Pet whereName($value)
 * @method static Builder|Pet wherePrice($value)
 * @property Category $category
 */
class Pet extends Model
{
    /** @var string[] */
    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
