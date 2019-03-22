<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Pet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ApiCartPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
        $this->seed('UserTableSeeder');
    }

    public function testGuestPayment(): void
    {
        $response = $this->post('api/cart/payment');

        $response->assertStatus(302);
    }

    public function testPayment(): void
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(factory(User::class)->create());
        $new = Pet::inRandomOrder()->first()->toArray();
        $new['quantity'] = 1;
        $this->json('POST', '/api/cart', $new)->assertStatus(200);

        $response = $this->post('api/cart/payment', ['nonce' => 'fake-valid-nonce']);

        $response->assertStatus(200);
    }
}
