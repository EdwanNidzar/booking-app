<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Penginapan</title>
  <link rel="icon" href="{{ asset('svg/logo.svg') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="text-center">Daftar Penginapan</h1>
      <div>
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#receiptModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-receipt" viewBox="0 0 16 16">
            <path
              d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
            <path
              d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
          </svg>
        </button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cartModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-bell-fill" viewBox="0 0 16 16">
            <path
              d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
          </svg>
        </button>
        @if (Auth::check())
          <span>{{ Auth::user()->name }}</span>
        @else
          <a href="{{ route('login') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-person" viewBox="0 0 16 16">
              <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg>
          </a>
        @endif
      </div>

    </div>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @elseif(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Modal Cart -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cartModalLabel">Booking Pending</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul id="cartList" class="list-group">
              <li class="list-group-item">Memuat data...</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Receipt -->
    <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="receiptModalLabel">Daftar Booking</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul id="receiptList" class="list-group">
              <li class="list-group-item">Memuat data...</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    @if ($penginapans->count() === 0)
      <div class="alert alert-warning mt-5" role="alert">
        Belum ada penginapan yang tersedia.
      </div>
    @else
      <h2 class="text-center mt-5">Daftar Penginapan</h2>
      <div class="row">
        @foreach ($penginapans as $penginapan)
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
              <img src="{{ asset('storage/' . $penginapan->photo) }}" class="card-img-top" alt="Gambar Penginapan">
              <div class="card-body">
                <h5 class="card-title">{{ $penginapan->nama_penginapan }}</h5>
                <p class="card-text text-muted">{{ $penginapan->location }}</p>
                <p class="card-text fw-bold">Rp {{ number_format($penginapan->price, 0, ',', '.') }} / malam</p>
                <button class="btn btn-primary" data-bs-toggle="modal"
                  data-bs-target="#detailModal{{ $penginapan->id }}">Detail</button>
                @if (Auth::check())
                  <button class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#orderModal{{ $penginapan->id }}">Pesan</button>
                @else
                  <a href="{{ route('login') }}" class="btn btn-success">Login untuk Pesan</a>
                @endif
              </div>
            </div>
          </div>

          <!-- Modal Detail -->
          <div class="modal fade" id="detailModal{{ $penginapan->id }}" tabindex="-1"
            aria-labelledby="modalLabel{{ $penginapan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel{{ $penginapan->id }}">{{ $penginapan->nama_penginapan }}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <img src="{{ asset('storage/' . $penginapan->photo) }}" class="img-fluid rounded mb-3"
                    alt="Gambar Penginapan">
                  <p><strong>Lokasi:</strong> {{ $penginapan->location }}</p>
                  <p><strong>Harga:</strong> Rp {{ number_format($penginapan->price, 0, ',', '.') }} / malam</p>
                  <p><strong>Fasilitas:</strong></p>
                  <ul>
                    @foreach ($penginapan->properties as $property)
                      <li>Tempat Tidur : {{ $property->beds }}</li>
                      <li>Kamar Mandi : {{ $property->beds }}</li>
                      <li>Fasilitas Lainnya : {{ $property->facilities }}</li>
                      <li>Maksimal {{ $property->max_guest }} tamu</li>
                    @endforeach
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Order -->
          <div class="modal fade" id="orderModal{{ $penginapan->id }}" tabindex="-1"
            aria-labelledby="orderLabel{{ $penginapan->id }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="orderLabel{{ $penginapan->id }}">Pesan
                    {{ $penginapan->nama_penginapan }}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('booking', $penginapan->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="penginapan_id" value="{{ $penginapan->id }}">
                    <div class="mb-3">
                      <label for="tanggal_checkin" class="form-label">Tanggal Check-in</label>
                      <input type="date" class="form-control" name="tanggal_checkin" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_checkout" class="form-label">Tanggal Check-out</label>
                      <input type="date" class="form-control" name="tanggal_checkout" required>
                    </div>
                    <div class="mb-3">
                      <label for="total_guest" class="form-label">Jumlah Tamu</label>
                      <input type="number" class="form-control" name="total_guest" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if ($aulas->count() === 0)
      <div class="alert alert-warning mt-5" role="alert">
        Belum ada aula yang tersedia.
      </div>
    @else
      <h2 class="text-center mt-5">Daftar Aula</h2>
      <div class="row">
        @foreach ($aulas as $aula)
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
              <img src="{{ asset('storage/' . $aula->photo) }}" class="card-img-top" alt="Gambar Aula">
              <div class="card-body">
                <h5 class="card-title">{{ $aula->nama_aula }}</h5>
                <p class="card-text text-muted">{{ $aula->location }}</p>
                <p class="card-text fw-bold">Rp {{ number_format($aula->price, 0, ',', '.') }} / hari</p>
                <button class="btn btn-primary" data-bs-toggle="modal"
                  data-bs-target="#detailModalAula{{ $aula->id }}">Detail</button>
                @if (Auth::check())
                  <button class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#orderModalAula{{ $aula->id }}">Pesan</button>
                @else
                  <a href="{{ route('login') }}" class="btn btn-success">Login untuk Pesan</a>
                @endif
              </div>
            </div>
          </div>

          <!-- Modal Detail Aula -->
          <div class="modal fade" id="detailModalAula{{ $aula->id }}" tabindex="-1"
            aria-labelledby="modalLabel{{ $aula->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel{{ $aula->id }}">{{ $aula->nama_aula }}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <img src="{{ asset('storage/' . $aula->photo) }}" class="img-fluid rounded mb-3"
                    alt="Gambar Aula">
                  <p><strong>Lokasi:</strong> {{ $aula->location }}</p>
                  <p><strong>Harga:</strong> Rp {{ number_format($aula->price, 0, ',', '.') }} / jam</p>
                  <p><strong>Fasilitas:</strong></p>
                  <ul>
                    @foreach ($aula->properties as $property)
                      <li>Kapasitas : {{ $property->max_guest }} orang</li>
                      <li>Fasilitas Lainnya : {{ $property->facilities }}</li>
                    @endforeach
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Order Aula -->
          <div class="modal fade" id="orderModalAula{{ $aula->id }}" tabindex="-1"
            aria-labelledby="orderLabel{{ $aula->id }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="orderLabel{{ $aula->id }}">Pesan
                    {{ $aula->nama_aula }}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('booking', $aula->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="aula_id" value="{{ $aula->id }}">
                    <div class="mb-3">
                      <label for="tanggal_checkin" class="form-label">Tanggal Check-in</label>
                      <input type="date" class="form-control" name="tanggal_checkin" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_checkout" class="form-label">Tanggal Check-out</label>
                      <input type="date" class="form-control" name="tanggal_checkout" required>
                    </div>
                    <div class="mb-3">
                      <label for="total_guest" class="form-label">Jumlah Tamu</label>
                      <input type="number" class="form-control" name="total_guest" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    @endif
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const baseUrl = @json(url('/'));
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const cartModal = document.getElementById("cartModal");

      cartModal.addEventListener("show.bs.modal", function() {
        fetch("{{ route('cart') }}")
          .then(response => response.json())
          .then(data => {
            const cartList = document.getElementById("cartList");
            cartList.innerHTML = "";

            if (data.length === 0) {
              cartList.innerHTML = "<li class='list-group-item text-center'>Tidak ada booking pending</li>";
            } else {
              data.forEach(booking => {
                let namaBooking = booking.penginapan ? booking.penginapan.nama_penginapan : (booking.aula ?
                  booking.aula.nama_aula : 'Unknown');

                // Determine the badge color based on booking status
                let badge = '';
                let bayarButton = ''; // Default button to be empty
                if (booking.status === 'pending') {
                  badge = '<span class="badge bg-warning text-dark">' + booking.status + '</span>';
                  bayarButton =
                    `<a href="${baseUrl}/payments/create/${booking.id}" class="btn btn-danger btn-sm">Bayar</a>`; // Only show the button if status is pending
                } else if (booking.status === 'waiting') {
                  badge = '<span class="badge bg-primary text-white">' + booking.status + '</span>';
                  // No button when status is waiting
                }

                cartList.innerHTML += `
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${namaBooking} - ${booking.check_in} s/d ${booking.check_out}
                    ${badge}
                    ${bayarButton}
                  </li>`;
              });
            }
          });
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const receiptModal = document.getElementById("receiptModal");

      receiptModal.addEventListener("show.bs.modal", function() {
        fetch("{{ route('receipt') }}")
          .then(response => response.json())
          .then(data => {
            const receiptList = document.getElementById("receiptList");
            receiptList.innerHTML = "";

            if (data.length === 0) {
              receiptList.innerHTML = "<li class='list-group-item text-center'>Tidak ada booking</li>";
            } else {
              data.forEach(booking => {
                let namaBooking = "Unknown";

                // Prioritize penginapan if exists, otherwise check aula
                if (booking.penginapan && booking.penginapan.nama_penginapan) {
                  namaBooking = booking.penginapan.nama_penginapan;
                } else if (booking.aula && booking.aula.nama_aula) {
                  namaBooking = booking.aula.nama_aula;
                }

                // Determine if the button should be displayed based on status
                let printButton = '';
                if (booking.status !== 'rejected') {
                  printButton =
                    `<a href="${baseUrl}/printReceipt/${booking.id}" target="_blank" class="btn btn-secondary btn-sm">Print Receipt</a>`;
                }

                receiptList.innerHTML += `
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      ${namaBooking} - ${booking.check_in} s/d ${booking.check_out}
                      ${printButton} 
                  </li>`;
              });
            }
          });
      });
    });
  </script>

</body>

</html>
