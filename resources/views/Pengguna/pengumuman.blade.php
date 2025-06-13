@extends('layouts.Pengguna')
@section('content')

<main class="main">

  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1 class="mb-3">Pengumuman</h1>
           
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{route('homepage')}}">Home</a></li>
          <li class="current">Pengumuman</li>
        </ol>
      </div>
    </nav>
  </div> <!-- End Page Title -->

  <div class="container my-5">
    <div class="row">
      @forelse($announcement as $item)
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm h-100">

            <div class="card-body">
              <h5 class="card-title">{{ $item->title }}</h5>
              
              @if($item->pdf_file)
                <a href="{{ route('pengumuman.download', $item->id) }}"
                   class="btn btn-sm btn-primary mb-3">
                  <i class="bi bi-download"></i> Download PDF
                </a>
              @endif
            </div>

            @if($item->gambar_url)
              <img src="{{ asset('storage/foto/' . $item->gambar_url) }}"
                   class="card-img-bottom img-fluid"
                   alt="Gambar Pengumuman">
            @else
              <img src="{{ asset('img/foto-tidak-ada.png') }}"
                   class="card-img-bottom img-fluid"
                   alt="Gambar Tidak Tersedia">
            @endif

          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p class="text-muted">Belum ada pengumuman yang tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>

</main>

@endsection
