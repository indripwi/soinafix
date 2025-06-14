@extends('layouts.Pengguna')

@section('content')
<main class="main">
  <!-- Page Title -->
  <div class="page-title bg-danger text-white py-5" data-aos="fade">
    <div class="container text-center">
      <h1 class="mb-1 display-5">Pengumuman</h1>
      <p class="mb-0 lead">Informasi terbaru untuk Anda</p>
    </div>
    <nav class="breadcrumbs mt-3">
      <div class="container">
        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
          <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white-50">Home</a></li>
          <li class="breadcrumb-item active text-white">Pengumuman</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Page Title -->

  <div class="container my-5">
    <div class="row justify-content-center">
      @forelse($announcement as $item)
      <div class="col-md-8 col-lg-6 mb-5" data-aos="fade-up">
        <div class="card shadow-lg border-0 text-center h-100">
          <!-- Judul di atas gambar -->
          <div class="card-header">
            <h4 class="card-title text-danger mb-0">{{ $item->title }}</h4>
          </div>

          @if($item->gambar_url)
          <img src="{{ asset('storage/foto/' . $item->gambar_url) }}" class="card-img-top" alt="Gambar Pengumuman">
          @else
          <img src="{{ asset('img/foto-tidak-ada.png') }}" class="card-img-top" alt="Gambar Tidak Tersedia">
          @endif

          <div class="card-footer bg-white border-0">
            @if($item->pdf_file)
              <a href="{{ route('pengumuman.download', $item->id) }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-download"></i> Download PDF
              </a>
            @else
              <span class="text-muted small">Tidak ada file PDF</span>
            @endif
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted fs-5">Belum ada pengumuman yang tersedia.</p>
      </div>
      @endforelse
    </div>
  </div>
</main>
@endsection
