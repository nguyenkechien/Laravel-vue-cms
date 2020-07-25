<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('assets', 'API\Images', ['only' => ['show']]);

Route::get('/tim-kiem', 'SearchController@index')->name('search');

Route::group(['prefix' => 'blogs'], function () {
  Route::get('/', 'BlogsController@index')->name('blogs.index');
  Route::get('/{blog}', 'BlogsController@show')->name('blogs.show');
  Route::get('/{blog}/{post}', 'BlogsController@post', ['middleware' => 'filter.post'])->name('blogs.post');
});

Route::group(['prefix' => 'san-pham'], function () {
  Route::get('/', 'ProductsController@index')->name('san-pham.index');
  Route::get('/{san_pham}', 'ProductsController@show')->name('san-pham.show');
  Route::get('/{san_pham}/{post}', 'ProductsController@post',  ['middleware' => 'filter.product'])->name('san-pham.post');
});

Route::post('/lien-he', 'SearchController@index')->name('lien-he');


Route::get('/admin{any}', 'AdminController@index')->where('any', '.*')->name('admin');
Auth::routes(['register' => false , 'password.reset' => false]);

Route::group(['prefix' => '/'], function () {
  Route::get('/', 'HomeController@index')->name('home');
  Route::get('/{param}', 'Pages@show')->name('page');
});



