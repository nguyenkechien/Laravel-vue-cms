<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class FilterPage
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
    $pages = $this->getViewedPages();

    if (!is_null($pages)) {
      $pages = $this->cleanExpiredViews($pages);
      $this->storePosts($pages);
    }

    return $next($request);
  }
  private function getViewedPages()
  {
    return $this->session->get('viewed_pages', null);
  }
  private function cleanExpiredViews($pages)
  {
    $time = time();

    // Let the views expire after one hour.
    $throttleTime = 3600;

    return array_filter($pages, function ($timestamp) use ($time, $throttleTime) {
      return ($timestamp + $throttleTime) > $time;
    });
  }

  private function storePosts($pages)
  {
    $this->session->put('viewed_pages', $pages);
  }
}
