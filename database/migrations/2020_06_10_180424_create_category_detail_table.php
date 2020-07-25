<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDetailTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('category', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      $table->string('description')->nullable();
      $table->string('meta_title')->nullable();
      $table->string('meta_description')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->string('param')->unique();
      $table->boolean('publish')->default(false);
      $table->unsignedInteger('parent_id')->nullable();
      $table->foreign('parent_id')->references('id')->on('category')->onDelete('set null');
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
    Schema::dropIfExists('category');
  }
}
