@extends('layouts.Admin') {{-- ganti sesuai layout adminmu --}}

@section('content')
<div class="container mt-5">
    <h2>Pengaturan Pendaftaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.setting.update') }}">
        @csrf
        <div class="mb-3">
            <label for="status" class="form-label">Status Pendaftaran</label>
            <select name="status" id="status" class="form-select">
                <option value="buka" {{ $status == 'buka' ? 'selected' : '' }}>Buka</option>
                <option value="tutup" {{ $status == 'tutup' ? 'selected' : '' }}>Tutup</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
