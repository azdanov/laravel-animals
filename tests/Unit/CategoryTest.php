<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Category;
use App\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function count;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
    }

    public function testHasManyRelation(): void
    {
        $category= Category::whereName('Cats')->first();
        $pets = Pet::whereCategoryId($category->id)->get()->toArray();

        $this->assertCount(count($pets), $category->pets);
    }
}
