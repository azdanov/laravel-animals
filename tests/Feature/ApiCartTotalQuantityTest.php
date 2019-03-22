<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Pet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;
use function array_pop;
use function json_decode;
use function reset;

class ApiCartTotalQuantityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
    }

    public function testTotalQuantity(): void
    {
        $this->withoutExceptionHandling();
        Passport::actingAs(factory(User::class)->create());

        $new = Pet::inRandomOrder()->first()->toArray();
        $new['quantity'] = 1;
        $this->json('POST', '/api/cart', $new)
            ->assertStatus(200);

        $response = $this->get('/api/cart/quantity');

        self::assertSame($new['quantity'], (int) $response->getContent());
    }
}
