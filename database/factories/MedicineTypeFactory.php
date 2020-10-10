<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\MedicineType;
use Faker\Generator as Faker;

$factory->define(MedicineType::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->word
	];
});
