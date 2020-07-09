<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    
    return [
        'title' => $faker->sentence(5),
        'description' => $faker->sentence(5),
        'owner_id'  => factory(App\User::class)->create(),   
    ];

});
