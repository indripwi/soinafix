@extends('layouts.Admin')

@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Pendaftar</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="{{ route('dashbord') }}">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href=>Pendaftar</a>
          </li>
          <li class="nav-item">
            <a href=>Detail</a>
          </li>
        </ul>
      </div>         
      <div class="card">
        <div class="card-header">
          <div class="card-title">Data Pendaftar</div>
        </div>
<!-- start body -->
  <div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Detail Data</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('pendaftardetail.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $pendaftar->nama }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $pendaftar->nik }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $pendaftar->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Tempat Tanggal Lahir</th>
                    <td>{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pendaftar->alamat }}</td>
                </tr>
                <tr>
                    <th>Sekolah</th>
                    <td>{{ $pendaftar->sekolah }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $pendaftar->kelas }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection                      