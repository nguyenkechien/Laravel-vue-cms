<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      UserTableSeed::class,
      CategoryTableSeeder::class,
      ImagesTableSeed::class,
      PostsTableSeeder::class,
      CategoryProductsTableSeeder::class,
      ProductsTableSeeder::class,
      BlocksTableSeed::class,
    ]);
  }
}
