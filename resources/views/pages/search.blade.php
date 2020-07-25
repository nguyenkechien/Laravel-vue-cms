@extends('layouts.app')

@section('content')
<div class="blog-page">
  @include('core.title-bar')
  <div id="wrapper-content">
    <div class="container">
      <div class="blog-list row ">
        <div class="blog-list-left col-xl-8 col-md-12 col-12 pb-3">
          @if (count($posts))
            @include('components.list-blog')
          @else
            {{ __('Không có kết quả') }}
          @endif
        </div>
        <div class="blog-list-right col-xl-4 col-md-12 col-12">
          @include('components.sidebar')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
