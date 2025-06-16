@extends('layouts.Pengguna')

@section('content')
    <main class="main">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            @if ($announcement->count())
                <div id="announcementCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($announcement as $index => $item)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="d-flex justify-content-center">
                                    <div class="card shadow-lg border-0 text-center" style="width: 25rem;">
                                        <div class="card-header">
                                            <h4 class="card-title text-danger mb-0">{{ $item->title }}</h4>
                                        </div>

                                        <div id="carouselPengumuman{{ $item->id }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                {{-- Gambar utama --}}
                                                @if ($item->gambar_url)
                                                    <div class="carousel-item active">
                                                        <img src="{{ asset('storage/foto/' . $item->gambar_url) }}"
                                                            class="d-block w-100" alt="Gambar utama"
                                                            style="max-height: 500px; object-fit: contain;">
                                                    </div>
                                                @endif

                                                {{-- Gambar tambahan --}}
                                                @foreach ($item->images as $key => $img)
                                                    <div
                                                        class="carousel-item {{ !$item->gambar_url && $key == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . $img->gambar_url) }}"
                                                            class="d-block w-100" alt="Gambar tambahan"
                                                            style="max-height: 500px; object-fit: contain;">
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- Tombol navigasi kiri kanan --}}
                                            @if ($item->gambar_url || $item->images->count())
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselPengumuman{{ $item->id }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Sebelumnya</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselPengumuman{{ $item->id }}"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Berikutnya</span>
                                                </button>
                                            @endif
                                        </div>



                                        <div class="card-footer bg-white border-0">
                                            @if ($item->pdf_file)
                                                <a href="{{ route('pengumuman.download', $item->id) }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-download"></i> Download PDF
                                                </a>
                                            @else
                                                <span class="text-muted small">Tidak ada file PDF</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                    </button>
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted fs-5">Belum ada pengumuman yang tersedia.</p>
                </div>
            @endif
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </main>
@endsection
