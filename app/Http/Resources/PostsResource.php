<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    // return parent::toArray($request);
    return [
      'id' => $this->id,
      'title' => $this->title,
      'content' => $this->content,
      'thumbnail' => $this->thumbnail,
      'meta_title' => $this->meta_title,
      'meta_description' => $this->meta_description,
      'meta_keywords' => $this->meta_keywords,
      'param' => $this->param,
      'view_count' => $this->view_count,
      'publish' => $this->publish,
      'category' => $this->category,
      'created_at' => (string) $this->created_at,
      'updated_at' => (string) $this->updated_at,
    ];
  }
}
