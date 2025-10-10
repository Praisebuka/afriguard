<header id="header"@if(Route::current()->getName() != 'home') class="header-fixed"@endif>
  <div class="container" style="max-width: 1500px">

    <div id="logo" class="pull-left">
      <h1 style="text-transform: none">
        <a href="{{ route('home') }}#intro">
          <span><i class="fa fa-shield" aria-hidden="true"></i></span>
          {{ env('APP_NAME', 'AfriGuard') }}
        </a>
      </h1>
    </div>

    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#about"> About </a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#pricing"> Plans & Pricing </a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#features"> Services </a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#contact"> Contact Us </a></li>
        <li class="buy-tickets"><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}login  "> Login </a></li>
        {{-- <li class="buy-tickets"><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}register"> Register </a></li> --}}
      </ul>
    </nav>
  </div>
</header>
