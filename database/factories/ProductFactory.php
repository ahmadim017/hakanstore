<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    $randomNumber = rand(100,300);
    $image = "https://picsum.photos/id/{$randomNumber}/200/300";
    $gram = "gram";
    
    return [
        'category_id' => Category::inRandomOrder()->first()->id,
        'tittle' => $faker->word(),
        'slug' => $faker->slug(),
        'content' => $faker->text(),
        'unit' => $gram,
        'unit_weight' => rand(3,10),
        'weight' => $faker->numberBetween(1000,5000),
        'price' => $faker->numberBetween(1000000, 10000000),
        'discount' => $faker->numberBetween(5,10),
        'keywords' => $faker->word(),
        'description' => $faker->text(),
        'image' => $image,
    ];
});
