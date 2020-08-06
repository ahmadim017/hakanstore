<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {

    $randomNumber = rand(100,300);
    $image = "https://picsum.photos/id/{$randomNumber}/200/300?grayscale";
    $status = ['ACTIVE','INACTIVE'];
    return [
        'image' => $image,
        'link' => $faker->url(),
        'status' => $status[rand(0,1)],
    ];
});
