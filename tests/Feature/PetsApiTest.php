<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Pet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;
use function count;

class PetsApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
    }

    public function testGuestAccess(): void
    {
        $response = $this->get('/api/pets');

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function testGuestDelete(): void
    {
        $id = 1;
        $response = $this->delete('/api/pets/' . $id);

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function testUserAccess(): void
    {
        Passport::actingAs(factory(User::class)->make());

        $response = $this->get('/api/pets');

        $response->assertStatus(200);
        $response->assertSeeText('Cats');
    }

    public function testUserDelete(): void
    {
        $id = 1;
        $before = count(Pet::all()->toArray());
        Passport::actingAs(factory(User::class)->make());

        $response = $this->delete('/api/pets/' . $id);
        $after = count(Pet::all()->toArray());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Pet was deleted.']);
        self::assertSame($after, $before - 1);
    }
}
