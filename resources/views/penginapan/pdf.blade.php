<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Penginapan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <img src="{{ public_path('svg/kop-surat.svg') }}" alt="Kop Surat" style="width: 100%;">
  <hr style="border: 1px solid black;">
  <h2 style="text-align: center;">Laporan Penginapan</h2>
  <table>
    <thead>
      <tr>
        <th>Photo</th>
        <th>Pemilik</th>
        <th>Nama Penginapan</th>
        <th>Lokasi</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Fasilitas</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($penginapans as $penginapan)
        <tr>
          <td><img src="{{ public_path('storage/' . $penginapan->photo) }}" alt="Photo" style="width: 100px;"></td>
          <td>{{ $penginapan->host->name }}</td>
          <td>{{ $penginapan->nama_penginapan }}</td>
          <td>{{ $penginapan->location }}</td>
          <td>Rp{{ number_format($penginapan->price, 0, ',', '.') }}</td>
          <td>{{ $penginapan->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}</td>
          <td>
            @if ($penginapan->properties->count())
              {{ $penginapan->properties->pluck('facilities')->join(', ') }}
            @else
              -
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div style="margin-top: 20px; text-align: right;">
    <p>Banjarmasin, {{ date('d F Y') }}</p>
    <p style="margin-top: 70px;">(_______________________)</p>
  </div>

</body>

</html>
