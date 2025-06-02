@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="card">

        {{-- Error Handling --}}
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

        <div class="card-header">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputModal">
                <i class="fas fa-plus-circle me-1"></i> Input Data Pengurus
            </button>
        </div>

        <div class="card-body">
            <form action="{{ route('pengurus.index') }}" method="GET" class="mb-3 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari nama pengurus, jabatan..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <a href="{{ route('pengurus.index') }}" class="btn btn-secondary">
                <i class="fas fa-sync-alt me-1"></i> Reset
            </a>
            <h3> Tabel Upload Pengurus </h3>
            <table class="table table-striped mt-3">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($coaches as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>
                            <img class="card-img-top"
                                src="{{ $item->foto_url ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}"
                                alt="Foto Pengurus" style="width: 100px; height: auto;" />
                        </td>
                        <td>
                            <a href="{{ route('pengurus.edit', $item->slug) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                            <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('pengurus.hapus', $item->slug) }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data pengurus yang diinput.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $coaches->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<!-- Modal Input -->
<div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="inputModalLabel">Input Data Pengurus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nama Pengurus</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_url" class="form-label">Gambar</label>
                        <input type="file" name="image" id="foto_url" class="form-control" required>
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
