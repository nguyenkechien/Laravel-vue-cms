<div id="sidebar" class="sidebar-right" role="complementary" itemscope="itemscope"
  itemtype="http://schema.org/WPSideBar">

  <div id="recent_posts" class="recent-posts">
    <div id="search" class="recent-posts-search recent-posts--pb">
      <form method="get" class="search-form form" action="{{ route('search') }}">
        <div>
          <label>
            <input type="search" class="sidebar-search form-field" placeholder="Tìm kiếm bài viết..." value=""
              name="search" title="Search text" required="">
          </label>
          <button type="submit" class="search-submit form-btn-submit">
            <i class="fal fa-search"></i>
          </button>
        </div>
      </form>
    </div>

    @php
    $newPost = $newPost ?? false;
    $tags = $tags ?? false;
    @endphp

    @if ($tags)
    <div class="wrap-recent-posts recent-posts--pb">
      <h3 class="recent-posts-title">Danh mục</h3>
      <div class="recent-posts-tags">
        @foreach ($tags as $item)
        @if ($isProduct ?? false)
        <a href="{{ route('san-pham.show', ['san_pham' => $item['param'] ?? '1']) }}" class="recent-posts-tag {{
            url()->current() == Request::is('san-pham/'.$item['param'])
            ? 'active' : '' }}">{{$item['name']}}</a>
        @else
        <a href="{{ route('blogs.show', ['blog' => $item['param'] ?? '1']) }}" class="recent-posts-tag {{
            url()->current() == Request::is('blogs/'.$item['param'])
            ? 'active' : '' }}">{{$item['name']}}</a>
        @endif

        @endforeach
      </div>
    </div>
    @endif

    @if ($newPost)
    <div class="wrap-recent-posts recent-posts--pb">
      <h3 class="recent-posts-title">Bài viết mới nhất</h3>
      @foreach($newPost as $item)
      @php
        if ($isProduct ?? false) {
          $item->route = route('san-pham.post', ['san_pham'=>$item->category_products->param, 'post'=>$item->param ]);
          $category = [
            'name' => $item->category_products->name,
            'route' => route('san-pham.show', ['san_pham'=>$item->category_products->param])
          ];
        } else {
          $item->route = route('blogs.post', ['blog'=>$item->category->param, 'post'=>$item->param ]);
          $category = [
            'name' => $item->category->name,
            'route' => route('blogs.show', ['blog'=>$item->category->param])
          ];
        };

      $data = [
        'route' => $item->route,
        'thumbnail'=> route('assets.show', $item->thumbnail['name']),
        'title' => $item->title,
        'category' => [
          'name' => $category['name'],
          'route' => $category['route']
        ],
        'view' => $item->view_count,
        'price' => $item->price ?? null
      ];
      @endphp
      @include('core.mini-post', $data)
      @endforeach
    </div>

    @endif

    <div class="recent-posts-advertise recent-posts--pb">
      {!! $Advertisement !!}
    </div>

  </div>
</div>
