<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'posts';
  protected $primarykey = 'id';
  protected $fillable = [
    'id', 'title', 'content', 'thumbnail_id',
    'meta_title', 'meta_description', 'meta_keywords',
    'tags', 'keywords', 'param', 'publish', 'category_id',
    'create_at', 'update_at'
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function thumbnail()
  {
    return $this->belongsTo(Images::class);
  }
}
