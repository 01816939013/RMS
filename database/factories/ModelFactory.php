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

$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->word,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Menu::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'type' => $faker->word,
        'description' => $faker->text,
        'status' => $faker->boolean,
        'image' => $faker->imageUrl($width=640,$height=300),
        'user_id' => $faker->numberBetween($min = 1, $max = 125),
    ];
});


$factory->define(App\Item::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'description' => $faker->text,
        'status' => $faker->boolean,
        'image' => $faker->imageUrl($width=640,$height=300),
        'user_id' => $faker->numberBetween($min = 1, $max = 125),
        'menu_id' => $faker->numberBetween($min = 1, $max = 50),
    ];
});

$factory->define(App\Meal::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'description' => $faker->text,
        'status' => $faker->boolean,
        'image' => $faker->imageUrl($width=640,$height=300),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'city' => $faker->city,
        'phone' => $faker->e164PhoneNumber,
        'password' => bcrypt(str_random(10)),
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {

    return [
        'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'cashIn' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'payment' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'change' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'status' => $faker->boolean,
        'customer_id' => $faker->numberBetween($min = 1, $max = 100),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'description' => $faker->text,
        'status' => $faker->boolean,
        'image' => $faker->imageUrl($width=640,$height=300),
        'customer_id' => $faker->numberBetween($min = 1, $max = 30),
        'order_id' => $faker->numberBetween($min = 1, $max = 100),
        'rate' => $faker->numberBetween($min = 1, $max = 5),
    ];
});