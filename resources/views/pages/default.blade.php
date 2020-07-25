@extends('layouts.app')

@section('content')
@include('core.title-bar')
<div id="wrapper-content">
  <div class="container">
    <div class="row ">
      <div class="col-12 py-3">
        <div class="ql-editor">
          {!! $content !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
