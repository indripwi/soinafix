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

        {{-- Jika pakai Toastr/Toast Success --}}
        @if (session()->has('success'))
        <script>
            toastr.success('{{ session('
                success ') }}');
        </script>
        @endif

        <div class="card-header">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus-circle me-1"></i> Input Prestasi
            </button>

        </div>
        <div class="card-body">
            <div class="card-sub">
                <h3> Table Upload Prestasi </h3>
            </div>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Cabang Olahraga</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prestasis as $item)
                    <tr>
                        <td>1</td>
                        <td>{{ $item->nama_atlet }}</td>
                        <td>{{ $item->cabang_olahraga }}</td>
                        <td>
                            <img class="card-img-top"
                                src="{{ $item->foto_url != null ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}"
                                alt="Card image cap" style="width: 100px; height: auto;" />
                        </td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('prestasi.edit', $item->slug) }}">
                                Edit
                            </a>
                            <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('prestasi.hapus', $item->slug) }}">
                                Hapus
                            </button>

                        </td>

                    </tr>
                     @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data prestasi yang diinput.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_atlet">Nama Atlet</label>
                        <input type="text" name="nama_atlet" id="nama_atlet" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cabang_olahraga">Cabang Olahraga</label>
                        <input type="text" name="cabang_olahraga" id="cabang_olahraga" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_url">Gambar</label>
                        <input type="file" name="image" id="foto_url" class="form-control-file" required>
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
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
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
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@endsection
