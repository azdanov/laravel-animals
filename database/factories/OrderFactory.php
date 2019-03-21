<?php

declare(strict_types=1);

use App\Pet;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(App\Order::class, static function (Faker $faker) {
    /** @var Pet $pet */
    $pet = Pet::inRandomOrder()->first();
    /** @var User $user */
    $user = User::inRandomOrder()->first();

    return [
        'name' => $pet->name ?? $faker->name,
        'price' => $pet->price ?? $faker->numberBetween(100, 8000),
        'quantity' => $faker->numberBetween(1, 20),
        'pet_id' => $pet->id ?? $faker->numberBetween(1, 20),
        'user_id' => $user->id ?? $faker->numberBetween(1, 20),
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
    ];
});
