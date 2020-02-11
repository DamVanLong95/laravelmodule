<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
    	'name' => $faker->name,
    	'birthdate'=> $faker->date($format = 'Y-m-d', $max = 'now'),
    	'sex'	=> $faker->randomElement(['1','2']),
    	'salary' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL) ,
    	'job'	=> $faker->word,
        //
    ];
});
