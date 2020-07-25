<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pages;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class BlogsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = Category::with('posts')->where(['publish' => 1])->get();
    $posts = Post::with('category')->orderBy('created_at', 'DESC')->whereNotNull('category_id')->paginate(10);
    $page = Pages::where('param', 'blogs')->with('meta_thumbnail')->first();
    if ($page) Event::dispatch('pages.view', $page);
    $data = [
      'categories' => $categories,
      'titleBar' => [
        'title' => 'Blogs',
        'breadCurrent' => 'Blogs',
      ],
      'posts' => $posts,
      'meta' => [
        'meta_title' => $page['meta_title'],
        'meta_keywords' => $page['meta_keywords'],
        'meta_description' => $page['meta_description'],
        'meta_thumbnail' => $page ? route('assets.show', $page->meta_thumbnail['name']) : null,
      ]
    ];
    return View('pages/blogs', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $blog
   * @return \Illuminate\Http\Response
   */
  public function show($blog)
  {
    $currentCategory = Category::where(['param' => $blog, 'publish' => 1])->first();
    $categories = Category::where(['publish' => 1])->orderBy('created_at', 'DESC')->get();
    $currentCategory->setRelation('posts', $currentCategory->posts()->orderBy('created_at', 'DESC')->paginate(10));
    $breadCurrent = $currentCategory->name;
    $data = [
      'categories' => $categories,
      'titleBar' => [
        'title' => 'Blogs: ' . $breadCurrent,
        'breadCurrent' => $breadCurrent,
      ],
      'posts' => $currentCategory->posts,
      'meta' => [
        'meta_title' => $currentCategory->meta_title,
        'meta_keywords' => $currentCategory->meta_keywords,
        'meta_description' => $currentCategory->meta_description,
      ]
    ];
    return View('pages/blogs', $data);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $blog
   * @param  int  $post
   * @return \Illuminate\Http\Response
   */

  public function post($blog, $post)
  {
    $currentCategory = Category::where('param', $blog)->first();
    $post = $currentCategory->setRelation('posts', $currentCategory->posts()->where(['publish' => 1, 'param' => $post])->first())->posts;

    if (!$post) return abort(404);

    $relatedPosts = $currentCategory
      ->setRelation('posts', $currentCategory
        ->posts()
        ->where(['publish' => 1, 'category_id' => $currentCategory->id,])
        ->whereNotIn('id', [$post['id']])
        ->take(3)
        ->get())
      ->posts;

    Event::dispatch('posts.view', $post);

    $data = [
      'titleBar' => [
        'title' => 'Bài viết: ' .  $post->title,
        'blog' => [
          'name' => $currentCategory->name,
          'route' => route('blogs.show', ['blog' => $currentCategory->param])
        ],
        'breadCurrent' =>  $post->title,
      ],
      'post' => $post,
      'route' => route('blogs.post', ['blog' => $currentCategory->param, 'post' => $post->param]),
      'relatedPosts' => $relatedPosts,
      'currentCategory' => $currentCategory,
      'meta' => [
        'meta_title' => $post['meta_title'],
        'meta_keywords' => $post['meta_keywords'],
        'meta_description' => $post['meta_description'],
      ]
    ];
    return View('pages/post', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
