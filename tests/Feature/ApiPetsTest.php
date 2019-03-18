<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Category;
use App\Pet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;
use function count;

class ApiPetsTest extends TestCase
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

    public function testAccess(): void
    {
        Passport::actingAs(factory(User::class)->make());

        $response = $this->get('/api/pets');

        $response->assertStatus(200);
        $response->assertSeeText('Cats');
    }

    public function testDelete(): void
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

    public function testAdd(): void
    {
        $before = count(Pet::all()->toArray());
        Passport::actingAs(factory(User::class)->make());
        Storage::fake('public');
        $file = UploadedFile::fake()->image('image.jpg');
        $this->json('POST', '/api/images', ['file' => $file]);
        Storage::disk('public')->assertExists(
            config('app.image_path') . '/' . $file->hashName()
        );
        $categoryId = Category::inRandomOrder()->pluck('id')->first();

        $response = $this->post('/api/pets', [
            'name' => 'Rodents',
            'description' => 'A mouse',
            'image' => $file->hashName(),
            'price' => 400,
            'category_id' => $categoryId,
        ]);
        $after = count(Pet::all()->toArray());

        $response->assertStatus(200);
        self::assertSame($after, $before + 1);
    }

    public function testAddAndDelete(): void
    {
        $before = count(Pet::all()->toArray());
        Passport::actingAs(factory(User::class)->make());
        Storage::fake('public');
        $file = UploadedFile::fake()->image('image.jpg');
        $this->json('POST', '/api/images', ['file' => $file]);
        Storage::disk('public')->assertExists(
            config('app.image_path') . '/' . $file->hashName()
        );
        $categoryId = Category::inRandomOrder()->pluck('id')->first();

        $response = $this->post('/api/pets', [
            'name' => 'Mouse',
            'description' => 'A mouse',
            'image' => $file->hashName(),
            'price' => 400,
            'category_id' => $categoryId,
        ]);
        $after = count(Pet::all()->toArray());

        $response->assertStatus(200);
        self::assertSame($after, $before + 1);

        $this->delete('/api/pets/' . $response->original['id']);

        Storage::disk('public')->assertMissing(
            config('app.image_path') . '/' . $file->hashName()
        );
    }

    public function testModify(): void
    {
        $this->withoutExceptionHandling();
        $id = 1;
        $before = Pet::whereId($id)->get();
        Passport::actingAs(factory(User::class)->make());
        Storage::fake('public');
        $file = UploadedFile::fake()->image('image.jpg');
        $this->json('POST', '/api/images', ['file' => $file]);
        Storage::disk('public')->assertExists(
            config('app.image_path') . '/' . $file->hashName()
        );
        $categoryId = Category::inRandomOrder()->pluck('id')->first();
        $response = $this->put('/api/pets/' . $id, [
            'name' => 'An Animal',
            'image' => $file->hashName(),
            'description' => 'A mouse or a dog or a cat',
            'price' => 4200,
            'category_id' => $categoryId,
        ]);
        $after = Pet::whereId($id)->first();

        $response->assertStatus(200);
        self::assertNotEquals($before, $after);
        self::assertEquals('An Animal', $after->name);
    }
}
