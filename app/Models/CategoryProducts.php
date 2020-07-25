<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProducts extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'category_products';
  protected $fillable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'param', 'publish'];
  public function products()
  {
    return $this->hasMany(Products::class);
  }
}
