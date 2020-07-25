<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class FilterProduct
{
  private $session;

  public function __construct(Store $session)
  {
    $this->session = $session;
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $products = $this->getViewedPosts();

    if (!is_null($products)) {
      $products = $this->cleanExpiredViews($products);
      $this->storePosts($products);
    }

    return $next($request);
  }
  private function getViewedPosts()
  {
    return $this->session->get('viewed_products', null);
  }
  private function cleanExpiredViews($products)
  {
    $time = time();

    // Let the views expire after one hour.
    $throttleTime = 3600;

    return array_filter($products, function ($timestamp) use ($time, $throttleTime) {
      return ($timestamp + $throttleTime) > $time;
    });
  }

  private function storePosts($products)
  {
    $this->session->put('viewed_products', $products);
  }
}
