<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Blocks as APIBlocks;
use App\Models\Blocks;
use App\Models\Category;
use App\Models\Pages;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class HomeController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    if ($request->has('category') && $request->category === 'all') {
      $posts = Post::with('category')->where('publish', 1)->whereNotNull('category_id')
        ->orderBy('view_count', 'DESC')
        ->paginate(8);
      return view('components.list-blog', ['posts' => $posts]);
    }

    if ($request->has('category')) {
      $category = Category::where(['param' => $request->category, 'publish' => 1])
        ->with(['posts' => function ($q) {
          $q->take(5);
        }])
        ->first();
      return view('components.list-blog', ['posts' => $category->posts, 'pagination' => false]);
    }

    $heroBanner = APIBlocks::show(Blocks::where(['name' => 'HeroBannerHome', 'publish' => 1])->first());
    $page = Pages::where('param', '/')->with('meta_thumbnail')->first();

    if ($page) Event::dispatch('pages.view', $page);

    $posts = Post::with(['category', 'thumbnail'])
      ->where('publish', 1)
      ->whereNotNull('category_id')
      ->orderBy('view_count', 'DESC')
      ->paginate(8);

    $category = Category::all()->random(8);
    $data = [
      'posts' => $posts,
      'category' => $category,
      'heroBanner' => $heroBanner ?? null,
      'meta' => [
        'meta_title' => $page['meta_title'],
        'meta_keywords' => $page['meta_keywords'],
        'meta_description' => $page['meta_description'],
        'meta_thumbnail' => $page ? route('assets.show', $page->meta_thumbnail['name']) : null,
      ]
    ];
    return view('pages/home')->with($data)->render();
  }
}
