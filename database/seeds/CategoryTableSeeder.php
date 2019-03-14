<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Cats',
                'image' => 'cat.svg',
                'display_order' => 1,
            ],
            [
                'name' => 'Dogs',
                'image' => 'dog.svg',
                'display_order' => 2,
            ],
            [
                'name' => 'Birds',
                'image' => 'bird.svg',
                'display_order' => 3,
            ],
        ]);
    }
}
