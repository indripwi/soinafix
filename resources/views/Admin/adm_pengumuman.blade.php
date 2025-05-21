@extends('layouts.Admin')

@section('content')
 <!-- breadcrumb -->
 <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Pengumuman</h3>
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
            <a href="{{ route('pengumuman') }}">Pengumuman</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Upload Info</div>
            </div>
          
        <!-- body -->
            <div class="mb-3">
            <label for="judul" class="form-label">Judul Pengumuman</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Pengumuman</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>

            <div class="mb-3">
            <label for="file" class="form-label">File (PDF, DOC, dll)</label>
                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
         </div>
        </div>
    </div>
  </div>
</div>
@endsection