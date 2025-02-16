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
  <h2 style="text-align: center;">Laporan Penginapan</h2>
  <table>
    <thead>
      <tr>
        <th>Pemilik</th>
        <th>Nama Penginapan</th>
        <th>Lokasi</th>
        <th>Harga</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($penginapans as $penginapan)
        <tr>
          <td>{{ $penginapan->host->name }}</td>
          <td>{{ $penginapan->nama_penginapan }}</td>
          <td>{{ $penginapan->location }}</td>
          <td>Rp{{ number_format($penginapan->price, 0, ',', '.') }}</td>
          <td>{{ $penginapan->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
