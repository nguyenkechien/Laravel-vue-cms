<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title')->unique();
      $table->text('content');
      $table->unsignedInteger('thumbnail_id')->unsigned()->index()->nullable()->references('id')->on('images')->onDelete('set null');
      $table->string('meta_title')->nullable();
      $table->string('meta_description')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->string('tags')->nullable();
      $table->string('keywords')->nullable();
      $table->string('param')->unique();
      $table->integer('view_count')->default(0);
      $table->boolean('publish')->default(false);
      $table->unsignedInteger('category_id')->unsigned()->index()->nullable();
      $table->foreign('category_id')->references('id')->on('category')->onDelete('set null');
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
    Schema::dropIfExists('posts');
  }
}
