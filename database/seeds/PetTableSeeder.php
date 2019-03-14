<?php

declare(strict_types=1);

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

        DB::table('menu_items')->insert([
            // Cats
            [
                'name' => 'Russian Blue',
                'category_id' => $catsId,
                'image' => 'russian_blue.jpg',
                'description' => 'The Russian Blue is a cat breed that comes in colors varying from a light shimmering silver to a darker, slate grey.',
                'price' => 80,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Persian cat',
                'category_id' => $catsId,
                'image' => 'persian_cat.jpg',
                'description' => 'The Persian cat is a long-haired breed of cat characterized by its round face and short muzzle.',
                'price' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Siamese cat',
                'category_id' => $catsId,
                'image' => 'siamese_cat.jpg',
                'description' => 'The Siamese cat is one of the first distinctly recognized breeds of Asian cat.',
                'price' => 90,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Maine Coon',
                'category_id' => $catsId,
                'image' => 'maine_coon.jpg',
                'description' => 'The Maine Coon is the largest domesticated cat breed. It has a distinctive physical appearance and valuable hunting skills.',
                'price' => 120,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Dogs
            [
                'name' => 'Garden Buffet',
                'category_id' => $dogsId,
                'image' => 'parmesan_deviled_eggs.jpg',
                'description' => 'Choose from our fresh local, organically grown ingredients to make a custom salad.',
                'price' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'House Salad',
                'category_id' => $dogsId,
                'image' => 'house_salad.jpg',
                'description' => 'Our house salad is made with romaine lettuce and spinach, topped with tomatoes, cucumbers, red onions and carrots. Served with a dressing of your choice.',
                'price' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Chef's Salad",
                'category_id' => $dogsId,
                'image' => 'chefs_salad.jpg',
                'description' => 'The chef’s salad has cucumber, tomatoes, red onions, mushrooms, hard-boiled eggs, cheese, and hot grilled chicken on a bed of romaine lettuce. Served with croutons and your choice of dressing.',
                'price' => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Quinoa Salmon Salad',
                'category_id' => $dogsId,
                'image' => 'quinoa_salmon_salad.jpg',
                'description' => 'Our quinoa salad is served with quinoa, tomatoes, cucumber, scallions, and smoked salmon. Served with your choice of dressing.',
                'price' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Birds
            [
                'name' => 'Classic Burger',
                'category_id' => $birdsId,
                'image' => 'classic_burger.jpg',
                'description' => 'Our classic burger is made with 100% pure angus beef, served with lettuce, tomatoes, onions, pickles, and cheese of your choice. Veggie burger available upon request. Served with French fries, fresh fruit, or a side salad.',
                'price' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tomato Bruschetta Tortellini',
                'category_id' => $birdsId,
                'image' => 'tomato_bruschetta_tortellini.jpg',
                'description' => 'This classic cheese tortellini is cooked in a sundried tomato sauce. Served with bruschetta topped with a tomato and basil marinara.',
                'price' => 14,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Handcrafted Pizza',
                'category_id' => $birdsId,
                'image' => 'handcrafted_pizza.jpg',
                'description' => 'Our thin crust pizzas are made fresh daily and topped with your choices of fresh meats, veggies, cheese, and sauce. Price includes two toppings. Add $1 for each additional topping.',
                'price' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Barbecued Tofu Skewers',
                'category_id' => $birdsId,
                'image' => 'barbecued_tofu_skewers.jpg',
                'description' => 'Our barbecued skewers include tofu, cherry tomatoes, bell peppers, and zucchini marinated in a ginger sesame sauce and charbroiled. Served with steamed rice.',
                'price' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Fiesta Family Platter',
                'category_id' => $birdsId,
                'image' => 'fiesta_family_platter.jpg',
                'description' => 'This platter is perfect for sharing! Enjoy our spicy buffalo wings, traditional nachos, and cheese quesadillas served with freshly made guacamole dip.',
                'price' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
