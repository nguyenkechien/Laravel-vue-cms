<div class="post-medium post-container">
  <div class="post-meta-thumb">
    <a href="{{ $route ?? '#'}}">
      <img src="{{$thumbnail ?? ''}}" alt="{{ $title ?? ''}}">
    </a>
  </div>
  <a href="{{ $route ?? ''}}" class="post-title">
    <h2 itemprop="headline">{{ $title ?? ''}}</h2>
  </a>
  @if ($price)
    <div class="post-meta-price"> {{ $price. ' ₫' ?? '' . ' ₫' }} </div>
  @endif
  <div class="post-meta-data">
    <div class="post-meta-categories">
      <i class="fal fa-tags"></i>
      <a href="{{ $titleBar['blog']['route'] }}" rel="category tag">{{$titleBar['blog']['name']}}</a>
    </div>
    <a href="#" class="post-meta-view">
      <i class="fal fa-eye"></i> {{ $view ?? 0}}
    </a>
  </div>

</div>
