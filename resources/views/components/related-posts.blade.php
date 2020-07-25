<div class="related py-3">
  <h3 class="related-title pb-3">{{$relatedTitle ?? ''}}</h3>

  <div class="related-posts row">
    @foreach ($relatedPosts as $item)
    @php
    if ($isProduct ?? false) {
      $item->route = route('san-pham.post', ['san_pham'=>$currentCategory->param, 'post'=>$item->param ]);
    } else {
      $item->route = route('blogs.post',['blog'=>$currentCategory->param, 'post'=>$item->param]);
    };
    $data = [
      'thumbnail' => route('assets.show', $item->thumbnail['name']),
      'title' => $item->title,
      'route' => $item->route,
      'view' => $item->view_count,
      'price' => $item->price ?? null
    ]
    @endphp
    <div class="col-lg-4 col-6">
      @include('core.medium-post', $data)
    </div>
    @endforeach
  </div>

</div>
