<nav class="navbar navbar-expand-md shadow-sm {{ Request::is('/') ? 'navbar-dark' : 'navbar-light bg-light' }} "
  id="main-menu">
  <div class="container">
    {{-- <a class="navbar-brand" href="{{ url('/') }}"> --}}
      {!! $Logo !!}
    {{-- </a> --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        <li class="nav-item {{ url()->current() == route('home') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('home') }}">
            {{ __('Trang chủ') }}
          </a>
        </li>
        <li class="nav-item {{ url()->current() == Request::is('/gioi-thieu') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('page', ['param'=> 'gioi-thieu']) }}">
            {{ __('Giới Thiệu') }}
          </a>
        </li>
        <li class="nav-item {{ url()->current() == route('blogs.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('blogs.index')}}">
            {{ __('Blog - Tin tức') }}
          </a>
        </li>

        <li class="nav-item {{ url()->current() == route('san-pham.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('san-pham.index')}}">
            {{ __('Sản phẩm') }}
          </a>
        </li>

        <li class="nav-item {{ url()->current() == Request::is('/lien-he') ? 'active' : '' }}">
          <a class="nav-link" href="{{  route('page', ['param'=> 'lien-he']) }}">
            {{ __('Liên hệ') }}
          </a>
        </li>

        {{-- /Guest --}}
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if(Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
        {{-- /Guest --}}
      </ul>
    </div>
  </div>
</nav>
