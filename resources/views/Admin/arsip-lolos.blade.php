@extends('layouts.Admin')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-center">Arsip Pendaftar yang Lolos</h2>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-success">
                    <a href="{{ route('pendaftar.exportLolosExcel') }}" class="btn btn-success mb-3">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>


                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No. Telepon</th>
                        <th>JK</th>
                        <th>Sekolah</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pendaftar }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->sekolah }}</td>
                            <td><span class="badge bg-success">Lolos</span></td>
                            <td>
                                <a href="{{ route('pendaftar.detail', $item->slug) }}"
                                    class="btn btn-sm btn-primary">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Belum ada pendaftar yang lolos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
