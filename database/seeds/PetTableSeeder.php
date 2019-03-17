<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PetTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = DB::select('select * from categories');
        $catIds = [];
        foreach ($categories as $cat) {
            $catIds[$cat->name] = $cat->id;
        }
        $catsId = $catIds['Cats'];
        $dogsId = $catIds['Dogs'];
        $birdsId = $catIds['Birds'];

        DB::table('pets')->truncate();

        $images = collect([
            'russian_blue.jpg',
            'persian_cat.jpg',
            'siamese_cat.jpg',
            'maine_coon.jpg',
            'labrador_retriever.jpg',
            'bulldog.jpg',
            'beagle.jpg',
            'chihuahua.jpg',
            'atlantic_canary.jpg',
            'lovebird.jpg',
            'amazon_parrot.jpg',
        ]);

        $images->each(static function ($image): void {
            copy(
                getcwd() . '/resources/images/pets/' . $image,
                getcwd() . '/public/storage/images/' . $image
            );
        });

        DB::table('pets')->insert([
            // Cats
            [
                'name' => 'Russian Blue',
                'category_id' => $catsId,
                'image' => $images->get(0),
                'description' => 'The Russian Blue is a cat breed that comes in colors varying from a light shimmering silver to a darker, slate grey.',
                'price' => 80 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Persian cat',
                'category_id' => $catsId,
                'image' => $images->get(1),
                'description' => 'The Persian cat is a long-haired breed of cat characterized by its round face and short muzzle.',
                'price' => 100 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Siamese cat',
                'category_id' => $catsId,
                'image' => $images->get(2),
                'description' => 'The Siamese cat is one of the first distinctly recognized breeds of Asian cat.',
                'price' => 90 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Maine Coon',
                'category_id' => $catsId,
                'image' => $images->get(3),
                'description' => 'The Maine Coon is the largest domesticated cat breed. It has a distinctive physical appearance and valuable hunting skills.',
                'price' => 120 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Dogs
            [
                'name' => 'Labrador Retriever',
                'category_id' => $dogsId,
                'image' => $images->get(4),
                'description' => 'The Labrador Retriever, or just Labrador, is a large type of retriever-gun dog. The Labrador is one of the most popular breeds of dog in Canada, the United Kingdom and the United States.',
                'price' => 200 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bulldog',
                'category_id' => $dogsId,
                'image' => $images->get(5),
                'description' => 'The Bulldog, also known as the British Bulldog or English Bulldog, is a medium-sized breed of dog. It is a muscular, hefty dog with a wrinkled face and a distinctive pushed-in nose.',
                'price' => 230 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Beagle',
                'category_id' => $dogsId,
                'image' => $images->get(6),
                'description' => 'The beagle is a breed of small hound that is similar in appearance to the much larger foxhound. The beagle is a scent hound, developed primarily for hunting hare (beagling).',
                'price' => 170 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Chihuahua',
                'category_id' => $dogsId,
                'image' => $images->get(7),
                'description' => 'The Chihuahua is the smallest breed of dog and is named after the state of Chihuahua in Mexico. Chihuahuas come in a wide variety of colors, and two coat lengths.',
                'price' => 250 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Birds
            [
                'name' => 'Atlantic canary',
                'category_id' => $birdsId,
                'image' => $images->get(8),
                'description' => 'The Atlantic canary, known worldwide simply as the wild canary and also called the common canary, is a small bird.',
                'price' => 100 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Black-winged lovebird',
                'category_id' => $birdsId,
                'image' => $images->get(9),
                'description' => 'The black-winged lovebird also known as Abyssinian lovebird is a mainly green bird of the parrot family.',
                'price' => 140 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Amazon Parrot',
                'category_id' => $birdsId,
                'image' => $images->get(10),
                'description' => 'Amazon parrot is a medium-sized mainly green parrot found in woodlands and dry tropical forests.',
                'price' => 150 * 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
