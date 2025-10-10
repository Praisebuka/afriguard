<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2> About AfriGuard </h2>
        <p>{{ $settings['about_description'] ?? '' }}</p>
      </div>
      <div class="col-lg-3">
        <h3> Find Us @ </h3>
        <p> <i class="fa fa-map-pin"></i> {!! $settings['about_where'] ?? '' !!}</p>
      </div>
      <div class="col-lg-3">
        <h3> MVP Launch </h3>
        <p>{!! $settings['about_when'] ?? '' !!}</p>
      </div>
    </div>
  </div>
</section>
