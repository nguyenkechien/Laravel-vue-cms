<?php

namespace App\Events;

use App\Models\Pages;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Session\Store;

class ViewPageHandler
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

  public function handle(Pages $page)
  {
    if (!$this->isPostViewed($page)) {
      $page->increment('view_count');
      $this->storePost($page);
    }
  }

  private function isPostViewed($page)
  {
    $viewed = $this->session->get('viewed_pages', []);

    return array_key_exists($page->id, $viewed);
  }

  private function storePost($page)
  {
    $key = 'viewed_pages.' . $page->id;

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
