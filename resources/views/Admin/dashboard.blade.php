@extends('layouts.Admin')

@section('content')
<div class="page-inner">
  <div class="pt-2 pb-4">
    <h3 class="fw-bold mb-1">Selamat Datang,</h3>
    <h6 class="text-muted mb-4">Anda Berhasil Login!</h6>
  </div>

  <div class="row g-4">

    {{-- Card Pendaftar --}}
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow rounded-4 p-3 h-100 hover-card">
        <div class="text-center">
          <div class="mb-3">
            <i class="fas fa-users fa-3x text-white bg-gradient-primary p-3 rounded-circle shadow"></i>
          </div>
          <h6 class="text-secondary mb-1">Pendaftar</h6>
          <h2 class="fw-bold">{{ number_format($jumlahPendaftar) }}</h2>
        </div>
      </div>
    </div>

    {{-- Card Program --}}
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow rounded-4 p-3 h-100 hover-card">
        <div class="text-center">
          <div class="mb-3">
            <i class="fas fa-clipboard-list fa-3x text-white bg-gradient-info p-3 rounded-circle shadow"></i>
          </div>
          <h6 class="text-secondary mb-1">Program</h6>
          <h2 class="fw-bold">{{ number_format($jumlahProgram) }}</h2>
        </div>
      </div>
    </div>

    {{-- Card Pengurus --}}
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow rounded-4 p-3 h-100 hover-card">
        <div class="text-center">
          <div class="mb-3">
            <i class="fas fa-user-tie fa-3x text-white bg-gradient-success p-3 rounded-circle shadow"></i>
          </div>
          <h6 class="text-secondary mb-1">Pengurus</h6>
          <h2 class="fw-bold">{{ number_format($jumlahPengurus) }}</h2>
        </div>
      </div>
    </div>

  </div>
</div>

<style>
  .bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
  }
  .bg-gradient-info {
    background: linear-gradient(135deg, #36b9cc, #2c9faf);
  }
  .bg-gradient-success {
    background: linear-gradient(135deg, #1cc88a, #17a673);
  }
  .hover-card:hover {
    transform: translateY(-5px);
    transition: 0.3s ease;
  }
</style>
@endsection
