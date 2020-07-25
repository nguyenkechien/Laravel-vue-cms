<div class="post-item post status-publish grid-item" data-id="{{ $id ?? '' }}">
  <div class="post-container grid-item-content">
    <div class="post-meta-thumb">
      <img width="1024" height="777" src="{{ $thumbnail ?? '' }}" class="post-img" alt="post-{{ $id ?? '' }}">
      <div class="post-overlay">
        <a href="{{ $route ?? '#' }}" class="post-overlay-item"
          title="Open the article - Trip that you’ll never ever forget">
          <div class="post-overlay-item-container">
            <i class="fal fa-link"></i>
          </div>
        </a>
        <a href="{{ $thumbnail ?? '#' }}" class="post-overlay-item"
          data-fancybox data-caption='{{ $title ?? '' }}'
          data-rel="lightcase">
          <div class="post-overlay-item-container">
            <i class="fal fa-search-plus"></i>
          </div>
        </a>
      </div>
    </div>

    <div class="post-content-container">
      <div class="post-meta-top">
      <time class="updated semantic" itemprop="dateModified" datetime="{{$date}}"></time>
        <a href="{{ $route ?? '#' }}" class="post-meta-date">{{$date->format('F d,Y')}}</a>
      </div>

      <a href="{{ $route ?? '#' }}" class="post-title">
        <h2 itemprop="headline" class="post-meta-title"> {{ $title ?? '' }} </h2>
      </a>
      @if ($price)
          <div class="post-meta-price" > {{ $price. ' ₫' ?? '' . ' ₫' }} </div>
      @endif
      <div class="post-meta-content" > {!! $content ?? '' !!} </div>

      <div class="post-meta-bottom">
        <a href="#" class="post-meta-view">
          <i class="fal fa-eye"></i> {{ $view ?? 0 }}
        </a>
        <div class="post-meta-categories">
          <i class="fal fa-tags"></i>
          <a href="{{$category['route']}}" rel="category tag">{{$category['name']}}</a>
        </div>

      </div>
    </div>
    @if ($price)
        <div class="post-meta-btn">
          <button class="btn">Mua Ngay</button>
        </div>
    @endif
  </div>
</div>
