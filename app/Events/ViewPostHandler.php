<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Session\Store;

class ViewPostHandler
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

  public function handle(Post $post)
  {
    if (!$this->isPostViewed($post)) {
      $post->increment('view_count');
      $this->storePost($post);
    }
  }

  private function isPostViewed($post)
  {
    $viewed = $this->session->get('viewed_posts', []);

    return array_key_exists($post->id, $viewed);
  }

  private function storePost($post)
  {
    $key = 'viewed_posts.' . $post->id;

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
