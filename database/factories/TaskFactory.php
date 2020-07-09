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
        'compleated'    =>  $faker->boolean(0),
        'project_id'    =>  factory(App\Project::class)
    ];
});
