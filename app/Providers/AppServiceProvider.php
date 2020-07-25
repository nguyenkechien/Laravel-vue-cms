<?php

namespace App\Providers;

use App\Http\Controllers\API\Blocks as APIBlocks;
use App\Http\Controllers\BladeRending;
use App\Models\Blocks;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // View::share('footer', );
    view()->composer(['*'], function ($view) {
      $logo = APIBlocks::show(Blocks::where('name', 'Logo')->first());
      $view->with('Logo', $logo->content ?? '');
      $advertisement = APIBlocks::show(Blocks::where('name', 'Advertisement')->first());
      $view->with('Advertisement', $advertisement->content ?? '');
    });
    view()->composer(['core.footer'], function ($view) {
      $footer = Blocks::where('name', 'Footer')->first();
      if ($footer) $contentFooter = BladeRending::bladeCompile($footer->content);
      $view->with('footer', $contentFooter ?? '');
    });

    view()->composer(['pages.home', 'pages.post', 'pages.search'], function ($view) {
      $newPost = Post::whereNotNull('category_id')->orderBy('created_at', 'DESC')->take(5)->get();
      $view->with('newPost', $newPost);
    });
  }
}
