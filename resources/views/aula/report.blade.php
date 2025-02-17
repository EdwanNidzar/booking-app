<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Aula</title>
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
  <h2 style="text-align: center;">Laporan Aula</h2>
  <table>
    <thead>
      <tr>
        <th>Photo</th>
        <th>Pemilik</th>
        <th>Nama Aula</th>
        <th>Lokasi</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Fasilitas</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($aulas as $aula)
        <tr>
          <td><img src="{{ public_path('storage/' . $aula->photo) }}" alt="Photo" style="width: 100px;"></td>
          <td>{{ $aula->host->name }}</td>
          <td>{{ $aula->nama_aula }}</td>
          <td>{{ $aula->location }}</td>
          <td>Rp{{ number_format($aula->price, 0, ',', '.') }}</td>
          <td>{{ $aula->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}</td>
          <td>
            @if ($aula->properties->count())
              {{ $aula->properties->pluck('facilities')->join(', ') }}
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
