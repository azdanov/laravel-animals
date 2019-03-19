<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Category;
use App\Http\Controllers\Api\CategoryController;
use App\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function json_decode;

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
        $category = Category::whereName('Cats')->first();

        $pets = Pet::whereCategoryId($category->id)->count();

        $this->assertCount($pets, $category->pets);
    }

    public function testGetCategories(): void
    {
        $categories = (new CategoryController())->index();

        self::assertIsString($categories);
        self::assertSame([
            [
                'id' => 1,
                'name' => 'Cats',
                'description' => 'A cat',
                'display_order' => '1',
                'image' => 'cat.svg',
            ],
            [
                'id' => 2,
                'name' => 'Dogs',
                'description' => 'A dog',
                'display_order' => '2',
                'image' => 'dog.svg',
            ],
            [
                'id' => 3,
                'name' => 'Birds',
                'description' => 'A bird',
                'display_order' => '3',
                'image' => 'bird.svg',
            ],
        ], json_decode($categories, true));
    }
}
