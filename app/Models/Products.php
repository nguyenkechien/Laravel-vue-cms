<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'products';
  protected $fillable = [
    'id', 'title', 'content', 'price', 'thumbnail_id',
    'meta_title', 'meta_description', 'meta_keywords',
    'tags', 'keywords', 'param', 'publish', 'category_products_id',
    'create_at', 'update_at'
  ];

  public function category_products()
  {
    return $this->belongsTo(CategoryProducts::class);
  }

  public function thumbnail()
  {
    return $this->belongsTo(Images::class);
  }
}
