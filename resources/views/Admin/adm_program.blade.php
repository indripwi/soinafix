@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="card">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan pada input Anda:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Toastr success --}}
        @if (session()->has('success'))
        <script>
            toastr.success('{{ session('
                success ') }}');
        </script>
        @endif

        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus-circle me-1"></i> Input Program
            </button>
        </div>

        <div class="card-body">
            <form action="{{ route('olahraga.index') }}" method="GET" class="mb-3 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari nama program..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
           <a href="{{ route('olahraga.index') }}" class="btn btn-secondary">
        <i class="fas fa-sync-alt me-1"></i> Reset
    </a>
            <div class="card-sub">
                <h3>Table Upload Program</h3>
            </div>
            <table class="table table-striped mt-3">
                
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($programs as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->sport_name }}</td>
                        <td>
                            <img class="card-img-top"
                                src="{{ $item->gambar_url ? asset('storage/foto/' . $item->gambar_url) : asset('img/foto-tidak-ada.png') }}"
                                alt="Card image cap" style="width: 100px; height: auto;" />
                        </td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('olahraga.edit', $item->slug) }}">
                                Edit
                            </a>
                            <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('olahraga.hapus', $item->slug) }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data program yang diinput.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $programs->links('pagination::bootstrap-4') }}

        </div>
    </div>
</div>

<!-- Modal Input Program -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('olahraga.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Program Olahraga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sport_name">Nama Olahraga</label>
                        <input type="text" name="sport_name" id="sport_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar_url">Gambar</label>
                        <input type="file" name="image" id="gambar_url" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Load SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data program akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('
        success ') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@endsection
