<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Bookings</title>
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
  <h2 style="text-align: center;">Laporan Bookings</h2>
  <table>
    <thead>
      <tr>
        <th>Nama Pengguna</th>
        <th>Nama Penginapan / Aula</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Jumlah Tamu</th>
        <th>Total Harga</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($bookings as $booking)
        <tr>
          <td>{{ $booking->user->name }}</td>
          <td>
            {{ $booking->penginapan ? $booking->penginapan->nama_penginapan : ($booking->aula ? $booking->aula->nama_aula : '-') }}
          </td>
          <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</td>
          <td>{{ $booking->total_guest }}</td>
          <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
          <td>
            @if ($booking->status === 'approved')
              <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-lg">Approved</span>
            @elseif ($booking->status === 'rejected')
              <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-200 rounded-lg">Rejected</span>
            @else
              <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-200 rounded-lg">Pending</span>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
