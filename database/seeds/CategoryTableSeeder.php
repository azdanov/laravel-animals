<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->truncate();

        $images = collect(['cat.svg', 'dog.svg', 'bird.svg']);

        $images->each(static function ($image): void {
            copy(
                getcwd() . '/resources/images/categories/' . $image,
                getcwd() . '/public/storage/images/' . $image
            );
        });

        DB::table('categories')->insert([
            [
                'name' => 'Cats',
                'image' => $images->get(0),
                'description' => 'A cat',
                'display_order' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dogs',
                'image' => $images->get(1),
                'description' => 'A dog',
                'display_order' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Birds',
                'image' => $images->get(2),
                'description' => 'A bird',
                'display_order' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
