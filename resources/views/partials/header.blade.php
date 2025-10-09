<header id="header"@if(Route::current()->getName() != 'home') class="header-fixed"@endif>
  <div class="container" style="max-width: 1500px">

    <div id="logo" class="pull-left">
      <h1 style="text-transform: none">
        <a href="{{ route('home') }}#intro">
          <span><i class="fa fa-camera" aria-hidden="true"></i></span>
          {{ env('APP_NAME', 'AfriGuard') }}
        </a>
      </h1>
    </div>

    <nav id="nav-menu-container">
      <ul class="nav-menu">
        {{-- <li class="menu-active"><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#intro">Home</a></li> --}}
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#about">About</a></li>
        {{-- <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#speakers">Speakers</a></li> --}}
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#schedule"> Our Events </a></li>
        {{-- <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#venue">Venue</a></li> --}}
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#hotels">Hotels</a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#gallery">Gallery</a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#supporters">Sponsors</a></li>
        <li><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#contact">Contact</a></li>
        {{-- <li class="buy-tickets"><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}#buy-tickets">Buy Tickets</a></li> --}}
        <li class="buy-tickets"><a href="{{ Route::current()->getName() != 'home' ? route('home') : '' }}register"> Register </a></li>
      </ul>
    </nav>
  </div>
</header>
