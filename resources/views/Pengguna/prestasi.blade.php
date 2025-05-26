@extends('layouts.Pengguna')
@section('content')
  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Prestasi</h1>
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li class="current">Prestasi</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Events Section -->
    <section id="events" class="events section">

      <div class="container" data-aos="fade-up">

        <div class="row">

          @foreach ($prestasi as $item)
         <div class="col-12 col-sm-6 col-lg-4 d-flex align-items-stretch mb-4">
  <div class="card">
    <div class="card-img">
      <img src="{{ $item->foto_url ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}" alt="Card image cap">
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ $item->nama_atlet }}</h5>
      <p class="fst-italic text-center">{{ $item->cabang_olahraga }}</p>
      <p class="card-text">{{ $item->deskripsi }}</p>
    </div>
  </div>
</div>

        @endforeach
          
        </div>

      </div>

    </section><!-- /Events Section -->

  </main>

  @endsection