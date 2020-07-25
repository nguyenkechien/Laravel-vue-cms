<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
  $now = new DateTime;
  return [
    'name' => $faker->unique()->name,
    'param' => str_replace(' ', '', $faker->unique()->name),
    'publish' => 1,
    'created_at' => $now->format('d-m-Y'),
    'updated_at' => $now->format('d-m-Y'),
  ];
});

// (bool)random_int(0, 1)
