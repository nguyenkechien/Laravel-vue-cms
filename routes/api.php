<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.jwt')->get('/user', function (Request $request) {
  return $request->user();
});

// 'middleware' => ['auth'],
Route::group(['middleware' => ['auth.jwt'], 'as' => 'api.', 'namespace' => 'API'], function () {
  Route::resource('posts', 'Posts', ['except' => ['create', 'edit']]);
  Route::resource('products', 'Products', ['except' => ['create', 'edit']]);
  Route::resource('category', 'Category', ['except' => ['create', 'edit']]);
  Route::resource('category_products', 'CategoryProducts', ['except' => ['create', 'edit']]);
  Route::resource('assets', 'Images', ['except' => ['create', 'edit', 'show']]);
  Route::resource('pages', 'Pages', ['except' => ['create', 'edit']]);
  Route::resource('blocks', 'Blocks', ['except' => ['create', 'edit']]);
});
