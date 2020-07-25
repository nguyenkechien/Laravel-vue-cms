<div class="titlebar py-4">
  <div class="container">
    <div class="titlebar-table d-flex flex-lg-row flex-md-column flex-column">
      <div class="titlebar-title m-auto ml-lg-0 pb-lg-0 pb-2">
        <h2>{{ $titleBar['title'] ?? '' }}</h2>
      </div>
      <div class="titlebar-level m-lg-0 m-auto">
        <div id="breadcrumbs" class="breadcrumb-trail breadcrumbs">

          <span class="titlebar-level-item">
            <a class="bread-link bread-home" href="{{ route('home') }}" title="Trang chủ">Trang chủ</a>
          </span>

          @php
          $param = $titleBar['blog'] ?? false;
          @endphp

          @if ($param)
          <span class="separator"> <i class="fal fa-chevron-right"></i> </span>
          <span class="titlebar-level-item">
            {{-- <a href="{{$param['url']}}">{{$param['name']}}</a> --}}
            <a href="{{ $param['route'] }}">{{$param['name']}}</a>
          </span>
          @endif

          <span class="separator"> <i class="fal fa-chevron-right"></i> </span>

          <span class="titlebar-level-item-current">
            <span class="bread-current" title="Trip that you’ll never ever forget">{{$titleBar['breadCurrent'] ?? ''}}</span>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
