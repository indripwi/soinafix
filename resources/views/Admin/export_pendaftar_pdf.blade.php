<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 10px;
        }
        .kop-surat img {
            float: left;
            width: 80px;
            height: 80px;
        }
        .kop-text {
            text-align: center;
            font-size: 14px;
        }
        hr {
            border: 1px solid black;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f3f3f3;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <img src="{{ public_path('admin/img/logo_soina.jpg') }}" alt="Logo">
        <div class="kop-text">
            <strong> Pengurus Cabang Special Olympics Indonesia</strong><br><strong>Kota Banjarmasin</strong>
            <br>
            Sekretariat: HKSN Permai Blok IIA No. 13 RT/RW 026/002 Alalak Utara,
            Banjarmasin Utara Kota Banjarmasin, 70119<br>
            Telepon: (0812) 8740 0666 | Email: soinakotabanjarmasin@gmail.com
        </div>
    </div>

    <hr>
    <h2>Daftar Pendaftar</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pendaftar</th>
                <th>NIK</th>
                <th>Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftars as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_pendaftar }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->nomor_telepon }}</td>
                <td>{{ $p->jenis_kelamin }}</td>
                <td>{{ $p->tempat_lahir }}, {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->status_verifikasi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
