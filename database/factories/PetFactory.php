<?php

declare(strict_types=1);

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(App\Pet::class, static function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(100, 8000),
        'image' => $faker->image(storage_path() . '/images', 400, 300, null, false),
        'category_id' => Category::inRandomOrder()->first()->id,
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
    ];
});
