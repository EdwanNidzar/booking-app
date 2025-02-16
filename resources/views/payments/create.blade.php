<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Pembayaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Selesaikan Pembayaran!</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('payments.store') }}" method="POST">
          @csrf
          <input type="hidden" name="booking_id" class="form-control" value="{{ $bookings->id }}" required>

          <div class="mb-3">
            <label class="form-label">Nama:</label>
            <input type="text" name="user_id" class="form-control" value="{{ $bookings->user->name }}" required>
          </div>
            <div class="mb-3">
            <label class="form-label">Nama Penginapan atau Nama Aula:</label>
            <input type="text" name="penginapan_aula" class="form-control"
              value="{{ $bookings->penginapan->nama_penginapan ?? $bookings->aula->nama_aula }}" readonly>
            </div>
          <div class="mb-3">
            <label class="form-label">Check In:</label>
            <input type="text" name="check_in" class="form-control" value="{{ $bookings->check_in }}" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Check Out:</label>
            <input type="text" name="check_out" class="form-control" value="{{ $bookings->check_out }}" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Total Guest:</label>
            <input type="text" name="total_guest" class="form-control" value="{{ $bookings->total_guest }}" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Total Price:</label>
            <input type="text" name="total_price" class="form-control" value="{{ $bookings->total_price }}" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Metode Pembayaran:</label>
            <select name="payment_method" class="form-select" required>
              <option value="Transfer Bank">Transfer Bank</option>
              <option value="OVO">OVO</option>
              <option value="GoPay">GoPay</option>
              <option value="Dana">Dana</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-100">Bayar</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
