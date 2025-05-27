@extends('layouts.Admin')

@section('content')
<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-3">Selamat Datang,</h3>
      <h6 class="op-7 mb-2">Anda Berhasil Login!</h6>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="card card-stats card-round">
        <div class="card-body text-center">
          <div class="icon-big text-center icon-primary bubble-shadow-small mb-3">
            <i class="fas fa-users fa-4x"></i>
          </div>
          <div class="numbers">
            <p class="card-category fs-4 fw-medium">Pendaftar</p>
            <h4 class="card-title fs-1 fw-bold">1,294</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
