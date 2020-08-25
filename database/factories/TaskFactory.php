<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\Project;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) 
{
    return [
        //
        'body'          =>  $faker->sentence(5),
        'completed'    =>  false,
        'project_id'    =>  factory(App\Project::class)
    ];
});
