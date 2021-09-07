<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Users;
use App\UserAddress;

$factory->define(App\Users::class, function (Faker $faker) {
	
    return [
        'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'email' => $faker->email
    ];
});
$factory->define(App\UserAddress::class, function (Faker $faker) {
	
    return [
        'address1' => $faker->address,
		'address2' => $faker->address,
		'city' => $faker->city,
		'state' => $faker->state,
		'zip' => $faker->postcode,
		'country' => $faker->country
    ];
});
