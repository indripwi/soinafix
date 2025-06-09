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
                    toastr.success('{{ session('success') }}');
                </script>
            @endif

            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fas fa-plus-circle me-1"></i> Input Hasil Pengumuman
</button>

            </div>
            <div class="card-body">
                <div class="card-sub">
                    <h3> Hasil Seleksi Pengumuman </h3>
                </div>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">File PDF</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $item)
                            <tr>
                                <td>1</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <img class="card-img-top"
                                    src="{{ $item->gambar_url != null ? asset('storage/foto/' . $item->gambar_url) : asset('img/foto-tidak-ada.png') }}"
                                    alt="" style="width: 100px; height: auto;" />
                                </td>
                                <td>
                                    @if($item->pdf_file)
                                        <a href="{{ asset('storage/announcements/' . $item->pdf_file) }}" target="_blank">
                                            <i class="fas fa-file-pdf text-danger"></i> Unduh PDF
                                        </a>
                                    @else
                                        <em class="text-muted">Tidak ada file</em>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ route('pengumuman.edit', $item->slug) }}">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('pengumuman.hapus', $item->slug) }}" onClick="confirm('Delete entry?')"
>
                                        hapus
                                    </a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title">Nama</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="foto_url">Gambar</label>
                            <input type="file" name="image" id="gambar_url" class="form-control-file" required>
                        </div>
                        <div class="form-group">
                            <label for="pdf_file">PDF</label>
                            <input type="file" name="pdf_file" id="pdf_file" class="form-control-file" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
