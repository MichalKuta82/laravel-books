<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'user_id' => 1,
        'country' => $faker->country
    ];
});

$factory->define(App\Book::class, function (Faker $faker) {
    return [
    	'title' => $faker->sentence(2,5),
        'author_id' => $faker->numberBetween(1,10),
        'publication_date' => $faker->date($format = 'Y-m-d'),
        'translations' => $faker->country,
    ];
});
