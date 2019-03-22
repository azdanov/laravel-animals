<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ApiBraintreeTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestAccess(): void
    {
        $response = $this->get('api/braintree/token');

        $response->assertStatus(302);
    }

    public function testToken(): void
    {
        Passport::actingAs(factory(User::class)->create());
        $response = $this->get('api/braintree/token');

        $response->assertStatus(200);

        $response->assertJson(['token' => true]);
    }
}
