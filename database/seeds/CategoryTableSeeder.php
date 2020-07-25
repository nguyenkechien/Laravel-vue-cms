<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // $category = [
    //   ['Blog - Tin Tức', 'blogs', 1, null],
    //   ['Sản phẩm', 'san-pham', 1, null],
    // ];

    // foreach ($category as $cate) {
    //   Category::create([
    //     'name' => $cate[0],
    //     'param' => $cate[1],
    //     'publish' => $cate[2],
    //     'parent_id' => $cate[3]
    //   ]);
    // }

    factory(App\Models\Category::class, 10)->create();
  }
}
