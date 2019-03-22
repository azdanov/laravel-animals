<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $file = new Filesystem();
        $file->cleanDirectory('public/images');

        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PetTableSeeder::class);
        $this->call(OrderTableSeeder::class);
    }
}
