<?php

namespace App\Events;

use App\Models\Products;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Session\Store;

class ViewProductHandler
{
  use Dispatchable, InteractsWithSockets, SerializesModels;
  private $session;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(Store $session)
  {
    $this->session = $session;
  }

  public function handle(Products $product)
  {
    if (!$this->isProductsViewed($product)) {
      $product->increment('view_count');
      $this->storeProducts($product);
    }
  }

  private function isProductsViewed($product)
  {
    $viewed = $this->session->get('viewed_products', []);

    return array_key_exists($product->id, $viewed);
  }

  private function storeProducts($product)
  {
    $key = 'viewed_products.' . $product->id;

    $this->session->put($key, time());
  }

  // /**
  //  * Get the channels the event should broadcast on.
  //  *
  //  * @return \Illuminate\Broadcasting\Channel|array
  //  */
  // public function broadcastOn()
  // {
  //   return new PrivateChannel('channel-name');
  // }
}
