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
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li class="current">Pengumuman</li>
          </ol>
        </div>
      </nav>
    </div> <!-- End Page Title -->
       
    <div class="container">
    @foreach($announcement as $item)
    <h2>{{ $item->title }}</h2>
    <ul class="list-group mt-4">
        <a href="{{ route('pengumuman.download', $item->pdf_file) }}" class="btn btn-primary">
                    Download PDF
                </a>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5></h5>
                    <img class="img-fluid"
                        src="{{ $item->gambar_url != null ? asset('storage/foto/' . $item->gambar_url) : asset('img/foto-tidak-ada.png') }}"
                        alt="Card image cap" />
                </div>
                
            </li>
        @endforeach
    </ul>
</div>
  </main>

  @endsection