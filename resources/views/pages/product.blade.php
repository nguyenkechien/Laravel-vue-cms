@extends('layouts.app')

@section('content')
<div class="blog-detail-page">
  @include('core.title-bar')
  <div id="wrapper-content">
    <div class="container">
      <div class="blog-list row ">
        <div class="blog-list-left col-xl-8 col-md-12 col-12">
          @include('components.post-detail')
          @include('components.related-posts', ['relatedTitle' => 'Sản phẩm tương tự'])
        </div>
        <div class="blog-list-right col-xl-4 col-md-12 col-12">
          @include('components.sidebar', ['newPost' => $newProducts])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
