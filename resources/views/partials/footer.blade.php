<footer id="footer">
  <div class="footer-top">
    <div class="container" style="max-width: 1400px">
      <div class="row">

        <div class="col-lg-5 col-md-6 footer-info">
          <img src="img/afriguard.png" alt="AfriGuard" style="width: 7rem;height:7rem">
          {{-- <span><i class="fa fa-camera" aria-hidden="true"></i></span>
          {{ env('APP_NAME', 'AfriGuard') }} --}}
          <p>{{ $settings['footer_description'] ?? '' }}</p>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          {{-- <h4> Home </h4> --}}
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#"> About us </a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#"> Contact us </a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#"> Contact us </a></li>
            @auth
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.home') }}">Admin Panel</a></li>
            @endauth
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="#"> Our Services </a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#"> Plan & Pricings </a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#"> Privacy policy </a></li>
            {{-- @guest
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('login') }}">Login</a></li>
            @endguest --}}
            @auth
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.home') }}">Admin Panel</a></li>
            @endauth
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact">
          <h4>Contact Us</h4>
          <p>
            {{-- {!! $settings['footer_address'] ?? '' !!}<br> --}}
            <strong>Phone:</strong> {{ $settings['contact_phone'] }}<br>
            <strong>Email:</strong> {{ $settings['contact_email'] }}<br>
          </p>

          <div class="social-links">
            <a href="{{ $settings['footer_twitter'] ?? '' }}" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="{{ $settings['footer_facebook'] ?? '' }}" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="{{ $settings['footer_instagram'] ?? '' }}" class="instagram"><i class="fa fa-instagram"></i></a>
            {{-- <a href="{{ $settings['footer_googleplus'] ?? '' }}" class="google-plus"><i class="fa fa-google-plus"></i></a> --}}
            <a href="{{ $settings['footer_linkedin'] ?? '' }}" class="linkedin"><i class="fa fa-linkedin"></i></a>
          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong>{{ env('APP_NAME', 'AfriGuard') }}</strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://twitter.com/Praisebuka"> Praisebuka </a>
    </div>
  </div>
</footer>
