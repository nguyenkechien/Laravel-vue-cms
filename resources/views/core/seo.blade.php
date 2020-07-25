<title>{{ $meta['meta_title'] ?? env('META_TITLE') }}</title>
<meta name="keywords" content="{{ $meta['meta_keywords']  ?? env('META_KEYWORDS') }}" />
<meta name="description" content="{{ $meta['meta_description'] ?? env('META_DESCRIPTION') }}" />
<meta name="date" content="2020-07-05" />
<meta name="sitecode" content="vn" />

{{-- twitter --}}
<meta name="twitter:card" content="Summary" />
<meta name="twitter:site" content="{{ url()->current() }}" />
<meta name="twitter:creator" content="{{ $meta['meta_title'] ?? env('META_TITLE') }}" />
<meta name="twitter:url" content="{{ url()->current() }}" />
<meta name="twitter:title" content="{{ $meta['meta_title'] ?? env('META_TITLE') }}" />
<meta name="twitter:description" content="{{$meta['meta_description'] ?? env('META_DESCRIPTION') }}" />
<meta name="twitter:image" content="{{ $meta['meta_thumbnail'] ?? asset('default-thumnail.png') }}" />

{{-- FaceBook --}}
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:image" content="{{$meta['meta_thumbnail'] ??  asset('default-thumnail.png') }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="{{ $meta['meta_title'] ?? env('META_TITLE') }}" />
<meta property="og:locale" content="vi-VN" />
<meta property="og:title" content="{{ $meta['meta_title'] ?? env('META_TITLE') }}" />
<meta property="og:description" content="{{$meta['meta_description'] ?? env('META_DESCRIPTION') }}" />
<meta property="og:country-name" content="vn" />

<meta itemprop="name" content="{{ $meta['meta_title'] ?? env('META_TITLE') }}">
<meta itemprop="image" content="{{$meta['meta_thumbnail'] ??  asset('default-thumnail.png') }}">
<meta itemprop="url" content="{{ url()->current() }}">
<meta itemprop="description" content="{{$meta['meta_description'] ?? env('META_DESCRIPTION')}}">
<meta itemprop="keywords" content="{{ $meta['meta_keywords']  ?? env('META_KEYWORDS') }}">

<meta name="format-detection" content="telephone=no" />
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
<link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}" />
<link rel="dns-prefetch" href="//fonts.googleapis.com" />
<link rel="dns-prefetch" href="//s.w.org" />
