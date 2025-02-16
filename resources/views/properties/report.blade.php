<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Property</title>
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
  <div class="container">
    <h1>Laporan Property</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama Properti</th>
          <th>Jenis</th>
          <th>Fasilitas</th>
          <th>Maksimal Tamu</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($properties as $property)
          <tr>
            <td>
              @if ($property->penginapan)
                {{ $property->penginapan->nama_penginapan }}
              @elseif($property->aula)
                {{ $property->aula->nama_aula }}
              @else
                -
              @endif
            </td>
            <td>{{ $property->jenis }}</td>
            <td>{{ $property->facilities ?? '-' }}</td>
            <td>{{ $property->max_guest }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</html>
