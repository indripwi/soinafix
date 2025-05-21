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
        </ul>
      </div>         
      <div class="card">
        <div class="card-header">
          <div class="card-title">Data Pendaftar</div>
        </div>                        
                  
    <!-- Projects table -->
        <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>No. Telepon</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendaftar as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->nama_pendaftar }}</td>
            <td>{{ $row->nik }}</td>
            <td>{{ $row->nomor_telpon }}</td>
            <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
            <td>{{ $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>
              <!-- Tombol Detail -->
                <a href="{{ url('/peserta/'.$row->id) }}" class="btn btn-info btn-sm">Detail</a>

                <!-- Tombol Hapus -->
                <form action="{{ url('/peserta/'.$row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

        </div>
      </div>             
  </div>
</div>
</div>
@endsection