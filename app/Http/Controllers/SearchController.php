<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $posts = [];
    if ($request->has('search')) {
      $posts = $this->searchPosts($request->search);
    }
    $data = [
      'posts' => $posts,
      'titleBar' => [
        'title' => 'Tìm kiếm: ' . $request->search,
        'breadCurrent' => $request->search ?? 'Tìm kiếm',
      ],
    ];
    return view('pages/search', $data);
  }

  private function searchPosts($s)
  {
    $query = Post::with('category')
      ->where('title', 'like', '%' . $s . '%')
      ->orWhere('content', 'like', '%' . $s . '%')
      ->orWhere('created_at', 'like', '%' . $s . '%')
      ->orWhere('param', 'like', '%' . $s . '%')
      ->orWhere('publish', 1)
      ->whereNotNull('category_id')
      ->paginate(10);
    return $query;
  }
}
