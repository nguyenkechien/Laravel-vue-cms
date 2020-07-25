<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pages', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      $table->text('content');
      $table->string('meta_title')->nullable();
      $table->string('meta_description')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->unsignedInteger('meta_thumbnail_id')->unsigned()->index()->nullable()->references('id')->on('images')->onDelete('set null');
      $table->string('param')->unique();
      $table->integer('view_count')->default(0);
      $table->boolean('publish')->default(false);
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
    Schema::dropIfExists('pages');
  }
}
