<div class="post-detail ql-editor">

  <div class="post-meta-thumb">
    <a href="{{ route('assets.show', $post->thumbnail['name']) }}" data-fancybox data-caption='{{ $post->title }}'>
      <img src="{{ route('assets.show', $post->thumbnail['name']) }}" class="post-meta-thumb-image" alt="{{ $post->title }}">
    </a>
  </div>


  <a href="{{ $route ?? '#' }}" class="post-title">
    <h1 itemprop="headline">{{ $post->title }}</h1>
  </a>
  @if ($post->price ?? false)
    <div class="post-meta-price"> {{ $post->price. ' ₫' ?? '' . ' ₫' }} </div>
  @endif

  <div class="post-meta-data">
    <div class="post-meta-left">
      <time class="updated semantic" itemprop="dateModified" datetime="{{$post->created_at}}"></time>
      <a href="{{ $route ?? '#' }}" class="post-meta-date">{{$post->created_at->format('F d,Y')}}</a>
    </div>

    <div class="post-meta-right">
      <div class="post-meta-categories">
        <i class="fal fa-tags"></i>
        <a href="{{ $titleBar['blog']['route'] }}" rel="category tag">{{$titleBar['blog']['name']}}</a>
      </div>
      <a href="javascript:void(0)" class="post-meta-view">
        <i class="fal fa-eye"></i> {{ $post->view_count ?? 0}}
      </a>
    </div>
  </div>

  <div class="post-content" itemprop="text">
    {!! $post->content !!}
  </div>

</div>
