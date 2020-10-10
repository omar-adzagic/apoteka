<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Medicine;
use Faker\Generator as Faker;

$factory->define(Medicine::class, function (Faker $faker) {
	return [
		'medicine_type_id' => $faker->numberBetween(1,20),
		'name'    => $faker->unique()->word,
		'quantity' => $faker->numberBetween(1,100),
		'price'   => $faker->randomFloat(2, 0, 50)
	];
});
