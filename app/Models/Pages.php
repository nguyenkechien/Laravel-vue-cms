<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'pages';
  protected $fillable = ['name', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'meta_thumbnail_id', 'param', 'publish'];
  public function meta_thumbnail()
  {
    return $this->belongsTo(Images::class);
  }
}
