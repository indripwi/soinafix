@extends('layouts.Admin')

@section('content')
<div class="container my-5">
    <h2>Detail Pendaftaran</h2>
    <table class="table table-bordered">
        <tr><th>Nama</th><td>{{ $pendaftaran->nama_pendaftar }}</td></tr>
        <tr><th>NIK</th><td>{{ $pendaftaran->nik }}</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir->format('d-m-Y') }}</td></tr>
        <tr><th>Alamat</th><td>{{ $pendaftaran->alamat }}</td></tr>
        <tr><th>Sekolah</th><td>{{ $pendaftaran->sekolah }}</td></tr>
        <tr><th>Kelas</th><td>{{ $pendaftaran->kelas }}</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($pendaftaran->status_verifikasi) }}</td></tr>
    </table>
    <a href="{{ route('pendaftar.arsipLolos') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
