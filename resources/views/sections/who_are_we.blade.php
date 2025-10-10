<section id="hotels" class="section-with-bg wow fadeInUp">

  <div class="container">
    <div class="section-header">
      <h2> What We Offer </h2>
      <p> Affordable SME services for Africans no matter where you are on the path to wealth </p>
    </div>

    <div class="row">
      {{-- @foreach($hotels as $hotel) --}}
        <div class="col-lg-4 col-md-6">
          <div class="hotel">
            <div class="hotel-img">
              <img src="{{ asset('img/whoarewe/protection.jpg') }}" alt="Affordable Protection" class="img-fluid">
            </div>
            <h3><a href="#"> Affordable Protection </a></h3>
            <div class="stars">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <p> You'd be getting a comprehensive enterprise-grade security </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="hotel">
            <div class="hotel-img">
              <img src="{{ asset('img/whoarewe/automated.png') }}" alt="Automated Operations" class="img-fluid">
            </div>
            <h3><a href="#"> Automated Operations </a></h3>
            <div class="stars">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <p> An automated process that won't take chunk of your time or eat up your calender before you fix </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="hotel">
            <div class="hotel-img">
              <img src="{{ asset('img/whoarewe/offline.png') }}" alt="Offline Capability" class="img-fluid">
            </div>
            <h3><a href="#"> Offline Capability </a></h3>
            <div class="stars">
              <i class="fa fa-star"></i>
            </div>
            <p> This system works offline on your behalf & also keeps you informed about the whole process and the mitigations you need work on </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="hotel">
            <div class="hotel-img">
              <img src="{{ asset('img/whoarewe/local_compliance.jpg') }}" alt="Offline Capability" class="img-fluid">
            </div>
            <h3><a href="#"> Local Compliance </a></h3>
            <div class="stars">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <p> We Abide by the rules & regulations of CSEAN, NITDA, CISA etc </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="hotel">
            <div class="hotel-img">
              <img src="{{ asset('img/whoarewe/easy_to_setup.jpg') }}" alt="Offline Capability" class="img-fluid">
            </div>
            <h3><a href="#"> Easy to Set Up </a></h3>
            <div class="stars">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <p> Our system is one of the most simple to set up. And you also get to see this for yourself </p>
          </div>
        </div>
      {{-- @endforeach --}}
    </div>
  </div>

</section>
