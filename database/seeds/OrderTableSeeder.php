<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(App\Order::class, 50)->create();
    }
}
