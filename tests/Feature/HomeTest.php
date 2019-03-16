<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Category;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function factory;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
    }

    public function testCanGetHome(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Animals');
    }

    public function testShowCategoriesInOrder(): void
    {
        $response = $this->get('/');

        $response->assertSeeTextInOrder(['Cats', 'Dogs', 'Birds']);
    }

    /** @throws Exception */
    public function testCategoriesChange(): void
    {
        factory(Category::class)->create(['name' => 'Test']);
        Category::whereId(1)->delete();

        $response = $this->get('/');

        $response->assertSee('Test');
        $response->assertDontSeeText('Cats');
    }
}
