@extends('layouts.Admin')

@section('content')
    <div class="container">
        <div class="card">

            {{-- Tampilkan error validasi --}}
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
                <!-- Tombol untuk membuka modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus-circle me-1"></i> Input Hasil Pengumuman
                </button>
            </div>

            <div class="card-body">
                <div class="card-sub">
                    <h3>Hasil Seleksi Pengumuman</h3>
                </div>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Gambar</th>
                            <th>File PDF</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if ($item->images && $item->images->count() > 0)
                                        @foreach ($item->images as $image)
                                            <img src="{{ asset('storage/' . $image->gambar_url) }}" alt="Gambar"
                                                style="width: 100px; height: auto; margin: 5px;">
                                        @endforeach
                                    @elseif ($item->gambar_url)
                                        <img src="{{ asset('storage/foto/' . $item->gambar_url) }}" alt="Gambar"
                                            style="width: 100px; height: auto;">
                                    @else
                                        <em class="text-muted">Tidak ada gambar</em>
                                    @endif
                                </td>


                                <td>
                                    @if ($item->pdf_file)
                                        <button type="button" class="btn btn-info btn-sm btn-preview-pdf"
                                            data-bs-toggle="modal" data-bs-target="#pdfPreviewModal"
                                            data-pdf-url="{{ asset('storage/announcement/' . $item->pdf_file) }}">
                                            <i class="fas fa-eye"></i> Lihat PDF
                                        </button>
                                    @else
                                        <em class="text-muted">Tidak ada file</em>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ route('pengumuman.edit', $item->slug) }}">
                                        Edit
                                    </a>
                                    <form action="{{ route('pengumuman.hapus', $item->slug) }}" method="POST"
                                        class="form-delete d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Input Pengumuman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="images">Gambar (bisa lebih dari 1)</label>
                            <input type="file" name="images[]" id="images" class="form-control-file" multiple>
                        </div>


                        <div class="form-group mb-3">
                            <label for="pdf_file">File PDF</label>
                            <input type="file" name="pdf_file" id="pdf_file" class="form-control">
                        </div>

                        <small class="text-muted">*Isi minimal salah satu dari: Judul, Gambar, atau File PDF</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Preview PDF -->
    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview File PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" style="height: 80vh;">
                    <iframe id="pdfViewer" src="" style="width: 100%; height: 100%;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert & Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            const previewButtons = document.querySelectorAll('.btn-preview-pdf');
            const pdfViewer = document.getElementById('pdfViewer');
            previewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const pdfUrl = this.getAttribute('data-pdf-url');
                    pdfViewer.src = pdfUrl;
                });
            });

            const pdfModal = document.getElementById('pdfPreviewModal');
            pdfModal.addEventListener('hidden.bs.modal', function() {
                pdfViewer.src = '';
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endsection
