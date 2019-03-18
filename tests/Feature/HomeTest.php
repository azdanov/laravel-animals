<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Category;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function factory;
use function route;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
    }

    public function testAccessHome(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSeeText('Animals');
    }

    public function testCategoriesShownInOrder(): void
    {
        $response = $this->get(route('home'));

        $response->assertSeeTextInOrder(['Cats', 'Dogs', 'Birds']);
    }

    /** @throws Exception */
    public function testCategoriesChange(): void
    {
        factory(Category::class)->create(['name' => 'Test']);
        Category::whereId(1)->delete();

        $response = $this->get(route('home'));

        $response->assertSee('Test');
        $response->assertDontSeeText('Cats');
    }
}
