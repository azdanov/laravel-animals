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

class ApiCartClearTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
    }

    public function testClearItem(): void
    {
        $this->withoutExceptionHandling();
        Passport::actingAs(factory(User::class)->create());

        $new = Pet::inRandomOrder()->first()->toArray();
        $new['quantity'] = 1;
        $this->json('POST', '/api/cart', $new)
            ->assertStatus(200);

        $this->delete('/api/cart/clear')->assertStatus(200);
        $response = $this->get('/api/cart');

        $result = json_decode($response->getContent(), true);

        self::assertNull($result);
    }

}
