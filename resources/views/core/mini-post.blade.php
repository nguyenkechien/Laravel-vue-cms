<div class="recent-posts-widgets">
  <div class="recent-posts-widgets-item">
    <div class="recent-posts-widgets-item-thumb">
      <a href="{{ $route ??  '#'}}">
        <div class="ratio">
          <div class="ratio-container ratio-container-square">
            <div class="ratio-content" style="background-image: url({{ $thumbnail ?? '' }});">
            </div>
          </div>
        </div>
        <div class="mini-overlay">
          <div class="mini-overlay-container">
            <div class="icon">
              <i class="fal fa-link"></i>
            </div>
          </div>
        </div>

        <div class="mini-view">{{$view ?? 0}}</div>
      </a>
    </div>
    <div class="recent-posts-widgets-item-content">
      <span class="post-meta-categories">
        <a href="{{$category['route']}}" rel="category tag">{{$category['name']}}</a>
      </span>

      <a href="{{ $route ??  '#'}}">
        <h6 class="post-meta-title">{{ $title ?? '' }}</h6>
      </a>
      @if ($price)
        <div class="post-meta-price"> {{ $price. ' ₫' ?? '' . ' ₫' }} </div>
      @endif
    </div>
  </div>
</div>
