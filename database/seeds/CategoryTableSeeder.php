<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'name' => 'Cats',
                'image' => 'cat.svg',
                'description' => 'A cat',
                'display_order' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dogs',
                'image' => 'dog.svg',
                'description' => 'A dog',
                'display_order' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Birds',
                'image' => 'bird.svg',
                'description' => 'A bird',
                'display_order' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
