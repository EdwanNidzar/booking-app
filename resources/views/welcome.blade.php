<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Penginapan</title>
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
    <h1 class="text-center mb-4">Daftar Penginapan</h1>

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
                <h5 class="modal-title" id="modalLabel{{ $penginapan->id }}">{{ $penginapan->nama_penginapan }}</h5>
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
                <h5 class="modal-title" id="orderLabel{{ $penginapan->id }}">Pesan {{ $penginapan->nama_penginapan }}
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
                    <input type="number" class="form-control" name="total_guest" required>
                  </div>
                  <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
