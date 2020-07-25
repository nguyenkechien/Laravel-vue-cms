<div class="blog-page-list">
  @include('core.loading', ['icon' => 'top', 'fullScreen' => false])

  <div class="posts grid">
    @foreach($posts ?? '' as $item)
    @php
    if ($isProduct ?? false) {
    # code...
      $item->route = route('san-pham.post', ['san_pham'=>$item->category_products->param, 'post'=>$item->param ]);
      $category = [
        'name' => $item->category_products->name,
        'route' => route('san-pham.show', ['san_pham'=>$item->category_products->param])
      ];
    } else {
    # code...
      $item->route = route('blogs.post', ['blog'=>$item->category->param, 'post'=>$item->param ]);
      $category = [
        'name' => $item->category->name,
        'route' => route('blogs.show', ['blog'=>$item->category->param])
      ];
    };

    $post = [
      'id' => $item->id,
      'price' => $item->price ?? null,
      'thumbnail' => route('assets.show', $item->thumbnail['name']),
      'content' => $item->content,
      'title' => $item->title,
      'param' => $item->param,
      'date' => $item->created_at,
      'route' => $item->route,
      'category' => [
        'name' => $category['name'],
        'route' => $category['route']
      ],
      'view' => $item->view_count
    ]
    @endphp
    @include('core.big-post', $post)
    @endforeach

  </div>

  @if ($pagination ?? true)
  <div class="pagination-box">
    {!! $posts->render('components.paginator') !!}
  </div>
  @endif
</div>
