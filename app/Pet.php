<?php

declare(strict_types=1);

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
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
 */
class Pet extends Model
{
}
