@extends('layouts.app')

@section('content')
<div class="home-page">
  {{-- @include('components.banner', ['tag' => 'Tất cả bài viết', 'srcBanner' => '//cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/Blog_title_image.jpg', 'title' => 'Trang chủ']) --}}
  @if ($heroBanner)
  {!! $heroBanner['content'] !!}
  @else
    @include('components.banner', ['tag' => 'Tất cả bài viết', 'srcBanner' =>
    '//cdn.jevelin.shufflehound.com/wp-content/uploads/sites/11/2016/11/Blog_title_image.jpg', 'title' => 'Trang chủ'])
  @endif
  <div id="wrapper-content">
    <div class="container">
      @include('components.category', ['category' => $category])

      <div class="blog-list row ">
        <div class="blog-list-left col-xl-8 col-md-12 col-12 pb-3">
          @include('components.list-blog')
        </div>
        <div class="blog-list-right col-xl-4 col-md-12 col-12">
          @include('components.sidebar', ['newPost' => $newPost])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
