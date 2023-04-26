@extends('user.layout.master')

@section('content')

<section class="contact px-5 " style="background-color: #EEEBDC" id="contact">
    <div class="container-lg py-5">
      <div class="row">
        <div class=" text-center">
          <p>Do you have any projects ?</p>
        <h2 class="h2 mb-4">I'm Available for freelancer.</h2>
        <a target="_blank" href="https://sayrgyiwoody.github.io/Portofolio-Using-Bootstrap/" class="btn btn-dark rounded">Contact Me</a>
        </div>
      </div>
    </div>
  </section>
  <div class="contact-form py-5 ">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-5 px-4">
          <div class="contact-item d-flex mb-4 ">
            <div class="icon text-primary fs-4">
              <i class="fa-solid fa-phone"></i>
            </div>
            <div class="text ms-3">
              <div class="fs-5">Phone</div>
              <div class="text-muted">09950214146</div>
            </div>
          </div>
          <div class="email d-flex mb-4">
            <div class="icon text-primary fs-4">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="text ms-3">
              <div class="fs-5">Email</div>
              <div class="text-muted">wytun8904@gmail.com</div>
            </div>
          </div>
          <div class="address d-flex mb-4">
            <div class="icon text-primary fs-4">
              <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div class="text ms-3">
              <div class="fs-5">Address</div>
              <div class="text-muted">Yangon</div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
            <form action="{{route('user#contact')}}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-6">
                      <input type="text" name="name" value="{{Auth::user()->name}}" placeholder="Your Name" class="  form-control mb-3 mb-lg-0 form-control-lg bg-white text-primary  fs-6 border-2">
                    </div>
                    <div class="col-lg-6">
                      <input type="text" name="email" value="{{Auth::user()->email}}" placeholder="Your Email" class="  form-control  form-control-lg bg-white text-primary  fs-6 border-2">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-lg-12">
                      <input type="text" name="subject"  placeholder="Subject" class="form-control form-control-lg  bg-white text-primary fs-6 border-2">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-lg-12">
                      <textarea name="message" class="form-control form-control-lg  bg-white text-primary fs-6 border-2" placeholder="Text anything you want to say..." cols="30" rows="10"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Send Message <i class="fa-solid fa-paper-plane ms-2"></i></button>
            </form>
        </div>
      </div>
    </div>
  </div>


@endsection
