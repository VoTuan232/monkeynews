<?php

use Faker\Generator as Faker;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
// Manually creating the relationship tree.
// $user = factory(User::class)->create();

$factory->define(App\Models\Post::class, function (Faker $faker) {
	$user = factory(User::class)->create();
    return [
        'title' => $faker->sentence,
        'slug' =>  $faker->slug,
        'body' =>  $faker->sentence,
        'user_id' => $user->id,
    ];
});
