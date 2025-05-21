@extends('layouts.Pengguna')
@section('content')

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Pengurus</h1>
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li class="current">Pengurus</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Trainers Section -->
    <section id="trainers" class="section trainers">

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="{{asset('Mentor/assets/img/team/team-1.jpg')}}" alt="" class="zoom-hover" width="200">
            </div>
            <div class="member-info text-center">
              <h4>Walter White</h4>
              <span>Business</span>
              <p></p>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="200">
            <div class="member-img">
              <img src="assets/img/team/team-2.jpg" alt="" class="zoom-hover" width="200">
            </div>
            <div class="member-info text-center">
              <h4>Sarah Jhonson</h4>
              <span>Marketing</span>
              <p></p>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="300">
            <div class="member-img">
              <img src="assets/img/team/team-3.jpg" alt="" class="zoom-hover" width="200">
            </div>
            <div class="member-info text-center">
              <h4>William Anderson</h4>
              <span>Maths</span>
              <p></p>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
            <div class="member-img">
              <img src="{{asset('Mentor/assets/img/team/team-4.jpg')}}" alt="" class="zoom-hover" width="200">
            </div>
            <div class="member-info text-center">
              <h4>Amanda Jepson</h4>
              <span>Foreign Languages</span>
              <p></p>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="500">
            <div class="member-img">
              <img src="{{asset('Mentor/assets/img/team/team-5.jpg')}}" alt="" class="zoom-hover" width="200">
            </div>
            <div class="member-info text-center">
              <h4>Brian Doe</h4>
              <span>Web Development<br></span>
              <p></p>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="600">
            <div class="member-img">
              <img src="{{asset('Mentor/assets/img/team/team-6.jpg')}}" alt="" class="zoom-hover" width="200">
            </div>
            <div class="member-info text-center">
              <h4>Josepha Palas</h4>
              <span>Business</span>
              <p></p>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Trainers Section -->

  </main>

 
  @endsection

