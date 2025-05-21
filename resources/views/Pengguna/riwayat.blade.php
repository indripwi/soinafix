@extends('layouts.Pengguna')

@section('content')
<main class="main">
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
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Sekolah</th>
                        <th>Kelas</th>
                        <th>Akta Kelahiran</th>
                        <th>Kartu Keluarga</th>
                        <th>Pas Foto</th>
                        <th>Raport Terakhir</th>
                        <th>Tes Psikologi</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftar as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->nama_pendaftar }}</td>
                        <td>{{ $row->nik }}</td>
                        <td>{{ $row->nomor_telepon }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{ $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $row->tempat_lahir }}</td>
                        <td>{{ $row->tanggal_lahir }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>{{ $row->sekolah }}</td>
                        <td>{{ $row->kelas }}</td>
                        <td>{{ $row->file_akta }}</td>
                        <td>{{ $row->file_kk }}</td>
                        <td>{{ $row->file_foto }}</td>
                        <td>{{ $row->file_raport }}</td>
                        <td>{{ $row->file_psikolog }}</td>
                        <td>{{ $row->file_psikolog }}</td>
                        <td>{{ $row->tanggal_daftar }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('pendaftaran'.$row->id) }}" class="btn btn-info btn-sm">Edit</a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('pendaftaran'.$row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
</main>
@endsection