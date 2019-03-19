<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Category;
use App\Http\Controllers\Api\PetsController;
use App\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function json_decode;

class PetsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CategoryTableSeeder');
        $this->seed('PetTableSeeder');
    }

    public function testBelongTo(): void
    {
        $id = Category::inRandomOrder()->pluck('id')->first();
        $pet = Pet::with('category')->whereCategoryId($id)->first();

        $this->assertTrue($pet->category->pets->contains($pet));
    }

    public function testGetPets(): void
    {
        $pets = (new PetsController())->index();

        self::assertIsString($pets);
        self::assertSame([
            'Cats' => [
                [
                    'id' => 1,
                    'description' => 'The Russian Blue is a cat breed that comes in colors varying from a light shimmering silver to a darker, slate grey.',
                    'name' => 'Russian Blue',
                    'price' => 80,
                    'image' => 'russian_blue.jpg',
                    'category_id' => '1',
                    'category' => [
                        'id' => 1,
                        'name' => 'Cats',
                        'description' => 'A cat',
                        'display_order' => '1',
                        'image' => 'cat.svg',
                    ],
                ],
                [
                    'id' => 2,
                    'description' => 'The Persian cat is a long-haired breed of cat characterized by its round face and short muzzle.',
                    'name' => 'Persian cat',
                    'price' => 100,
                    'image' => 'persian_cat.jpg',
                    'category_id' => '1',
                    'category' => [
                        'id' => 1,
                        'name' => 'Cats',
                        'description' => 'A cat',
                        'display_order' => '1',
                        'image' => 'cat.svg',
                    ],
                ],
                [
                    'id' => 3,
                    'description' => 'The Siamese cat is one of the first distinctly recognized breeds of Asian cat.',
                    'name' => 'Siamese cat',
                    'price' => 90,
                    'image' => 'siamese_cat.jpg',
                    'category_id' => '1',
                    'category' => [
                        'id' => 1,
                        'name' => 'Cats',
                        'description' => 'A cat',
                        'display_order' => '1',
                        'image' => 'cat.svg',
                    ],
                ],
                [
                    'id' => 4,
                    'description' => 'The Maine Coon is the largest domesticated cat breed. It has a distinctive physical appearance and valuable hunting skills.',
                    'name' => 'Maine Coon',
                    'price' => 120,
                    'image' => 'maine_coon.jpg',
                    'category_id' => '1',
                    'category' => [
                        'id' => 1,
                        'name' => 'Cats',
                        'description' => 'A cat',
                        'display_order' => '1',
                        'image' => 'cat.svg',
                    ],
                ],
            ],
            'Dogs' => [
                [
                    'id' => 5,
                    'description' => 'The Labrador Retriever, or just Labrador, is a large type of retriever-gun dog. The Labrador is one of the most popular breeds of dog in Canada, the United Kingdom and the United States.',
                    'name' => 'Labrador Retriever',
                    'price' => 200,
                    'image' => 'labrador_retriever.jpg',
                    'category_id' => '2',
                    'category' => [
                        'id' => 2,
                        'name' => 'Dogs',
                        'description' => 'A dog',
                        'display_order' => '2',
                        'image' => 'dog.svg',
                    ],
                ],
                [
                    'id' => 6,
                    'description' => 'The Bulldog, also known as the British Bulldog or English Bulldog, is a medium-sized breed of dog. It is a muscular, hefty dog with a wrinkled face and a distinctive pushed-in nose.',
                    'name' => 'Bulldog',
                    'price' => 230,
                    'image' => 'bulldog.jpg',
                    'category_id' => '2',
                    'category' => [
                        'id' => 2,
                        'name' => 'Dogs',
                        'description' => 'A dog',
                        'display_order' => '2',
                        'image' => 'dog.svg',
                    ],
                ],
                [
                    'id' => 7,
                    'description' => 'The beagle is a breed of small hound that is similar in appearance to the much larger foxhound. The beagle is a scent hound, developed primarily for hunting hare (beagling).',
                    'name' => 'Beagle',
                    'price' => 170,
                    'image' => 'beagle.jpg',
                    'category_id' => '2',
                    'category' => [
                        'id' => 2,
                        'name' => 'Dogs',
                        'description' => 'A dog',
                        'display_order' => '2',
                        'image' => 'dog.svg',
                    ],
                ],
                [
                    'id' => 8,
                    'description' => 'The Chihuahua is the smallest breed of dog and is named after the state of Chihuahua in Mexico. Chihuahuas come in a wide variety of colors, and two coat lengths.',
                    'name' => 'Chihuahua',
                    'price' => 250,
                    'image' => 'chihuahua.jpg',
                    'category_id' => '2',
                    'category' => [
                        'id' => 2,
                        'name' => 'Dogs',
                        'description' => 'A dog',
                        'display_order' => '2',
                        'image' => 'dog.svg',
                    ],
                ],
            ],
            'Birds' => [
                [
                    'id' => 9,
                    'description' => 'The Atlantic canary, known worldwide simply as the wild canary and also called the common canary, is a small bird.',
                    'name' => 'Atlantic canary',
                    'price' => 100,
                    'image' => 'atlantic_canary.jpg',
                    'category_id' => '3',
                    'category' => [
                        'id' => 3,
                        'name' => 'Birds',
                        'description' => 'A bird',
                        'display_order' => '3',
                        'image' => 'bird.svg',
                    ],
                ],
                [
                    'id' => 10,
                    'description' => 'The black-winged lovebird also known as Abyssinian lovebird is a mainly green bird of the parrot family.',
                    'name' => 'Black-winged lovebird',
                    'price' => 140,
                    'image' => 'lovebird.jpg',
                    'category_id' => '3',
                    'category' => [
                        'id' => 3,
                        'name' => 'Birds',
                        'description' => 'A bird',
                        'display_order' => '3',
                        'image' => 'bird.svg',
                    ],
                ],
                [
                    'id' => 11,
                    'description' => 'Amazon parrot is a medium-sized mainly green parrot found in woodlands and dry tropical forests.',
                    'name' => 'Amazon Parrot',
                    'price' => 150,
                    'image' => 'amazon_parrot.jpg',
                    'category_id' => '3',
                    'category' => [
                        'id' => 3,
                        'name' => 'Birds',
                        'description' => 'A bird',
                        'display_order' => '3',
                        'image' => 'bird.svg',
                    ],
                ],
            ],
        ], json_decode($pets, true));
    }
}
