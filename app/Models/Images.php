<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'images';
  protected $fillable = ['name', 'url'];

  public function posts()
  {
    return $this->hasMany(Post::class);
  }
  public function products()
  {
    return $this->hasMany(Products::class);
  }
}
