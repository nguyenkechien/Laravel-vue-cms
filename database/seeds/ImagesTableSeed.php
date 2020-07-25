<?php

use App\Models\Images;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImagesTableSeed extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //

    $now = new DateTime;
    $src = [
      "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/1-1024x777.jpg",
      "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/2-660x660.jpg",
      "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/3-1024x817.jpg",
      "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/11-838x1024.jpg",
      "https://cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/1-1024x777.jpg",
    ];

    foreach ($src as $url) {
      $info = pathinfo($url);
      $randomName = str_shuffle(MD5(microtime()));
      $contents = file_get_contents($url);
      $path = 'public/photos/' . $randomName . '.' . $info['extension'];
      Storage::put($path, $contents);
      Images::create([
        'name' => $randomName,
        'url' => $path,
        'created_at' => $now->format('d-m-Y'),
        'updated_at' => $now->format('d-m-Y'),
      ]);
    }
  }
}
