<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Category;
use App\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function route;

class PetsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
    }

    public function testLoadsPets(): void
    {
        $response = $this->get(route('pets'));

        $response->assertStatus(200);
        $response->assertSeeText('Pets Selection');
    }

    public function testShowCategories(): void
    {
        $response = $this->get(route('pets'));
        $categories = Category::select('name')->get()->pluck('name')->toArray();

        $response->assertSeeTextInOrder($categories);
    }

    public function testShowPets(): void
    {
        $response = $this->get(route('pets'));
        $categories = Category::select('id')->get()->pluck('id')->toArray();
        $pets = Pet::whereIn('category_id', $categories)->pluck('name')->toArray();

        $response->assertSeeTextInOrder($pets);
    }
}
