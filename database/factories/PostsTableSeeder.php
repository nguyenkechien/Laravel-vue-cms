<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\Category;
use App\Models\Images;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
  $now = new DateTime;
  $src = [
    "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/1-1024x777.jpg",
    "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/2-660x660.jpg",
    "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/3-1024x817.jpg",
    "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/11-838x1024.jpg",
    "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/1-1024x777.jpg",
  ];
  return [
    'title' => $faker->unique()->name,
    'param' => str_replace(' ', '', $faker->unique()->name),
    'content' => $faker->text,
    'thumbnail_id' => Images::all()->random()->id,
    'publish' => 1,
    'category_id' => Category::all()->random()->id,
    'created_at' => $now->format('d-m-Y'),
    'updated_at' => $now->format('d-m-Y'),
  ];
});

// (bool)random_int(0, 1)
