@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header mb-4">
            <h3 class="fw-bold mb-2">Pendaftar</h3>
            <ul class="breadcrumbs mb-0">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <span>Pendaftar</span>
                </li>
            </ul>
        </div>

        <!-- Filter Form -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('pendaftar.index') }}" method="GET">
                    <div class="row align-items-center gy-2">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama/NIK/telepon..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="tahun" class="form-select">
                                <option value="">Pilih Tahun</option>
                                @foreach ($tahunList as $tahun)
                                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 d-flex gap-2">
                            <a href="{{ route('pendaftar.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync-alt me-1"></i> Reset
                            </a>
                            <a href="{{ route('pendaftar.export', ['search' => request('search'), 'tahun' => request('tahun')]) }}" class="btn btn-primary">
                                <i class="fas fa-file-pdf me-1"></i> Export PDF
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Pendaftar -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="card-title fw-semibold mb-0">Data Pendaftar</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
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
                                <th>Status Verifikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftars as $index => $item)
                            <tr class="text-nowrap">
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
                                    @if ($item->$file)
                                        <a href="{{ asset('storage/' . $item->$file) }}" target="_blank" class="btn btn-sm btn-outline-primary mb-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pendaftar.download', ['file' => $item->$file]) }}" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        <em class="text-muted">-</em>
                                    @endif
                                </td>
                                @endforeach

                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <form action="{{ route('pendaftar.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        <select name="status_verifikasi" onchange="this.form.submit()" class="form-select form-select-sm">
                                            <option value="menunggu" {{ $item->status_verifikasi === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="lolos" {{ $item->status_verifikasi === 'lolos' ? 'selected' : '' }}>Lolos</option>
                                            <option value="tidak lolos" {{ $item->status_verifikasi === 'tidak lolos' ? 'selected' : '' }}>Tidak Lolos</option>
                                        </select>
                                    </form>
                                    <small class="text-muted">Status: {{ $item->status_verifikasi }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('pendaftar.hapus', ['slug' => $item->slug]) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
