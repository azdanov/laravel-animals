<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Category;
use App\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
    }

    public function testBelongTo(): void
    {
        $id = Category::inRandomOrder()->pluck('id')->first();
        $pet = Pet::with('category')->whereCategoryId($id)->first();

        $this->assertTrue($pet->category->pets->contains($pet));
    }
}
