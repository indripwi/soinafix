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
            <form action="{{ route('pendaftar.index') }}" method="GET" class="mb-3">
                <div class="row">
                    <!-- Search bar -->
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama/NIK/telepon..."
                            value="{{ request('search') }}">
                    </div>

                    <!-- Filter tahun -->
                    <div class="col-md-3">
                        <select name="tahun" class="form-control">
                            <option value="">-- Filter Tahun --</option>
                            @foreach ($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="col-md-5 d-flex gap-2">
                        <!-- Tombol Reset -->
                        <a href="{{ route('pendaftar.index') }}" class="btn btn-secondary">
                            <i class="fas fa-sync-alt me-1"></i> Reset
                        </a>

                        <!-- Tombol Export PDF -->
                        <a href="{{ route('pendaftar.export', ['search' => request('search'), 'tahun' => request('tahun')]) }}"
                            class="btn btn-primary">
                            <i class="fas fa-file-pdf me-1"></i> Export PDF
                        </a>
                    </div>

                </div>
            </form>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Pendaftar</div>
                </div>

                <!-- Projects table -->
                <div class="card-body">
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
                                @foreach ($pendaftars as $index => $item)
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
                                        @php
                                            $folderMap = [
                                                'file_akta' => 'akta',
                                                'file_kk' => 'kk',
                                                'file_foto' => 'foto',
                                                'file_raport' => 'raport',
                                                'file_psikolog' => 'psikolog',
                                            ];
                                        @endphp

                                        @foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $file)
                                            <td>
                                                @if ($item->$file)
                                                    <a href="{{ asset('storage/' . $item->$file) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary mb-1">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <a href="{{ route('pendaftar.download', ['file' => $item->$file]) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-download"></i> Unduh
                                                    </a>
                                                @else
                                                    <em class="text-muted">-</em>
                                                @endif
                                            </td>
                                        @endforeach

                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('pendaftaran.edit', ['slug' => $item->slug]) }}"
                                                class="btn btn-success btn-sm">Edit</a>
                                            </a>
                                            <form action="{{ route('pendaftaran.hapus', ['slug' => $item->slug]) }}"
                                                method="POST">
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
