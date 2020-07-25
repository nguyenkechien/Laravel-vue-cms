<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'category';

  protected $fillable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'param', 'publish'];

  public function posts()
  {
    return $this->hasMany(Post::class);
  }
}
