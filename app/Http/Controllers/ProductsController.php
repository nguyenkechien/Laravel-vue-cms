<?php

namespace App\Http\Controllers;

use App\Models\CategoryProducts;
use App\Models\Pages;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;


class ProductsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = CategoryProducts::with('products')->where(['publish' => 1])->orderBy('created_at', 'DESC')->get();
    $posts = Products::with('category_products')->whereNotNull('category_products_id')->orderBy('created_at', 'DESC')->paginate(10);
    $page = Pages::where('param', 'san-pham')->with('meta_thumbnail')->first();
    if ($page) Event::dispatch('pages.view', $page);
    $data = [
      'categories' => $categories,
      'titleBar' => [
        'title' => 'Sản phẩm',
        'breadCurrent' => 'Sản phẩm',
      ],
      'posts' => $posts,
      'isProduct' => true,
      'meta' => [
        'meta_title' => $page['meta_title'],
        'meta_keywords' => $page['meta_keywords'],
        'meta_description' => $page['meta_description'],
        'meta_thumbnail' => $page ? route('assets.show', $page->meta_thumbnail['name']) : null,
      ]
    ];
    return View('pages/products', $data);
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
   * @param  int  $san_pham
   * @return \Illuminate\Http\Response
   */
  public function show($san_pham)
  {
    $categories = CategoryProducts::where(['publish' => 1])->orderBy('created_at', 'DESC')->get();
    $currentCategory = $categories->where('param', $san_pham)->first();
    $currentCategory->setRelation('products', $currentCategory->products()->orderBy('created_at', 'DESC')->paginate(10));
    $data = [
      'categories' => $categories,
      'titleBar' => [
        'title' => 'Sản phẩm: ' . $currentCategory->name,
        'breadCurrent' => $currentCategory->name,
      ],
      'posts' => $currentCategory->products,
      'isProduct' => true,
      'meta' => [
        'meta_title' => $currentCategory->meta_title,
        'meta_keywords' => $currentCategory->meta_keywords,
        'meta_description' => $currentCategory->meta_description,
      ]
    ];
    return View('pages/products', $data);
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
    $newProducts = Products::find(1)->orderBy('created_at', 'DESC')->take(5)->get();
    $currentCategory = CategoryProducts::where('param', $blog)->first();
    $products = $currentCategory->setRelation('products', $currentCategory->products()->where(['publish' => 1, 'param' => $post])->first())->products;
    if (!$products) return abort(404);

    $relatedPosts = $currentCategory
      ->setRelation('products', $currentCategory
      ->products()
      ->where(['publish' => 1, 'category_products_id' => $currentCategory->id,])
      ->whereNotIn('id', [$products->id])
      ->take(3)
      ->get())
      ->products;

    Event::dispatch('products.view', $products);

    $data = [
      'newProducts' => $newProducts,
      'titleBar' => [
        'title' => 'Sản phẩm: ' .  $products->title,
        'blog' => [
          'name' => $currentCategory->name,
          'route' => route('san-pham.show', ['san_pham' => $currentCategory->param])
        ],
        'breadCurrent' =>  $products->title,
      ],
      'post' => $products,
      'route' => route('san-pham.post',['san_pham'=>$currentCategory->param, 'post'=>$products->param]),
      'relatedPosts'=> $relatedPosts,
      'currentCategory' => $currentCategory,
      'isProduct' => true,
      'meta' => [
        'meta_title' => $products['meta_title'],
        'meta_keywords' => $products['meta_keywords'],
        'meta_description' => $products['meta_description'],
      ]
    ];
    return View('pages/product', $data);
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
