<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    $randomNumber = rand(1,100);
    $image = "https://picsum.photos/id/{$randomNumber}/200/300";
    return [
        'name' => $faker->word(),
        'slug' => $faker->slug(),
        'image' => $image,
    ];
});
