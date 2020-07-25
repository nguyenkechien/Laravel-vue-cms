<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title')->unique();
      $table->text('content');
      $table->double('price');
      $table->unsignedInteger('thumbnail_id')->unsigned()->index()->nullable()->references('id')->on('images')->onDelete('set null');
      $table->string('meta_title')->nullable();
      $table->string('meta_description')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->string('tags')->nullable();
      $table->string('keywords')->nullable();
      $table->string('param')->unique();
      $table->integer('view_count')->default(0);
      $table->boolean('publish')->default(false);
      $table->unsignedInteger('category_products_id')->unsigned()->index()->nullable();
      $table->foreign('category_products_id')->references('id')->on('category_products')->onDelete('set null');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
}
