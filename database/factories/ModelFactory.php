<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(UnitConnection\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(UnitConnection\Models\Property::class, function (Faker\Generator $faker){

	return [
		'name' => $faker->sentence(3),
		'address_street' => $faker->streetAddress,
		'address_city' => $faker->city,
		'address_postcode' => $faker->postcode,
		'address_country' => 'US'
	];
});
