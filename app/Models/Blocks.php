<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'blocks';
  protected $fillable = ['name', 'content', 'publish'];

}
