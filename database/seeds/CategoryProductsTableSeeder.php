<?php

use Illuminate\Database\Seeder;

class CategoryProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\CategoryProducts::class, 10)->create();
    }
}
