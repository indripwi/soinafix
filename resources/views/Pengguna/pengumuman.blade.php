@extends('layouts.Pengguna')
@section('content')

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Pengumuman</h1>
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('homepage')">Home</a></li>
            <li class="current">Pengumuman</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->
       
  </main>

  @endsection