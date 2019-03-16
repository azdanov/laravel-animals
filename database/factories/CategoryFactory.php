<?php

declare(strict_types=1);

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(App\Category::class, static function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->imageUrl(),
        'description' => $faker->sentence,
        'display_order' => $faker->numberBetween(0, 10),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
