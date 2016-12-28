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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//User Factory
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10)
    ];
});

//Company Factory
$factory->define(App\Company::class, function (Faker\Generator $faker) {
    $company_name = $faker->company;
    return [
        'company_name' => $company_name,
        'user_id' => factory(App\User::class)->create(['account_type' => 'company', 'name' => $company_name])->id,
        'address' => $faker->address,
        'contact' => $faker->phoneNumber
    ];
});

//Syndicate Factory
$factory->define(App\Syndicate::class, function (Faker\Generator $faker) {
    $syndicate_name = $faker->company;
    return [
        'name' => $faker->name,
        'user_id' => factory(App\User::class)->create(['account_type' => 'syndicate', 'name' => $syndicate_name])->id,
        'address' => $faker->address,
        'contact' => $faker->phoneNumber
    ];
});