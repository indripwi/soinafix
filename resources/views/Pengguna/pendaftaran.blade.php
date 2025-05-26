@extends('layouts.Pengguna')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Pendaftaran</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="current">Pendaftaran</li>
                </ol>
            </div>
        </nav>
    </div>

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
                <script>
                    toastr.success('{{ session('success') }}');
                </script>
            @endif

            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6 mb-3">
                    <label for="nama_pendaftar" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_pendaftar" name="nama_pendaftar" value="{{ old('nama_pendaftar') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                </div>

                <div class="col-12 mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sekolah" class="form-label">Asal Sekolah</label>
                    <input type="text" class="form-control" id="sekolah" name="sekolah" value="{{ old('sekolah') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas') }}" required>
                </div>

                <hr class="my-4">
                <h5 class="mb-3">Upload Dokumen</h5>

                @foreach ([
                    'file_akta' => 'Akta Kelahiran',
                    'file_kk' => 'Kartu Keluarga',
                    'file_foto' => 'Pas Foto',
                    'file_raport' => 'Raport Terakhir',
                    'file_psikolog' => 'Tes Psikologi'
                ] as $name => $label)
                    <div class="col-md-6 mb-3">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        <input class="form-control" type="file" id="{{ $name }}" name="{{ $name }}" required>
                    </div>
                @endforeach

                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-danger px-5 py-2">Kirim Pendaftaran</button>
                </div>
            </form>

            <div class="container py-5">
                <h2 class="mb-4 text-center">Riwayat Pendaftaran</h2>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-danger text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>No. Telpon</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Sekolah</th>
                                <th>Kelas</th>
                                <th>Akta</th>
                                <th>KK</th>
                                <th>Foto</th>
                                <th>Raport</th>
                                <th>Psikologi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftaran as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_pendaftar }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nomor_telepon }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->sekolah }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    @foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $file)
                                        <td>
                                            @if($item->$file)
                                                <a href="{{ asset('storage/pendaftarans/' . $item->$file) }}" target="_blank">
                                                    <i class="fas fa-file-pdf text-danger"></i> Unduh
                                                </a>
                                            @else
                                                <em class="text-muted">-</em>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                      <a href="{{ route('pendaftaran.edit', ['slug' => $item->slug]) }}" class="btn btn-success btn-sm">Edit</a>
                                    </a>
                                        <form action="{{ route('pendaftaran.hapus', ['slug' => $item->slug]) }}" method="POST">
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
</main>
@endsection
