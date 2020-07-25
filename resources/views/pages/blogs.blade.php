@extends('layouts.app')

@section('content')
<div class="blog-page">
  @include('core.title-bar')
  <div id="wrapper-content">
    <div class="container">
      <div class="blog-list row ">
        <div class="blog-list-left col-xl-8 col-md-12 col-12 pb-3">
          @include('components.list-blog')
        </div>
        <div class="blog-list-right col-xl-4 col-md-12 col-12">
          @include('components.sidebar', ['tags' => $categories])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
