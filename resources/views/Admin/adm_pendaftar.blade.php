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
                                        @foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $file)
                                            <td>
                                                @if ($item->$file)
                                                    <a href="{{ asset('storage/pendaftarans/' . $item->$file) }}"
                                                        target="_blank">
                                                        <i class="fas fa-file-pdf text-danger"></i> Unduh
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
