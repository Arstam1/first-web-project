<style>
  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Warna hitam dengan opacity 0.5 */
    z-index: 999; /* Z-index yang lebih tinggi dari konten utama */
    display: none; /* Mulai tersembunyi */
  }

  .popup {
    display: none; /* Mulai tersembunyi */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    z-index: 1000; /* Z-index yang lebih tinggi dari overlay */
  }
  
  .popup-content {
    /* Gaya untuk konten di dalam pop-up */
  }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Deposit Manager</h1>
</div>
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif
<div class="card col-md-8">
  <div class="card-body">
    <h5 class="card-title"><i class="bi bi-wallet mx-2"></i>Total Deposit Member</h5>
    <p class="card-text" >Rp. {{ number_format($totalBalance, 0, ',', '.') }}</p>
  </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h5">Riwayat Transaksi</h1>    
</div>

<div class="row">
  <div class="col-md-10">
    <form action="/dashboard/deposit" method="get">
      {{-- <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-danger" type="submit">Search</button>
      </div>
      <div class="input-group mb-3">
        <select class="form-select" name="status">
          <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
          <option value="sukses" {{ request('status') == 'sukses' ? 'selected' : '' }}>Sukses</option>
          <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
        <button class="btn btn-primary" type="submit">Filter</button>
      </div> --}}

      <div class="input-group mb-3">
        <div style="width: 60px" class="mx-1"><input type="number" class="form-control" placeholder="Entries" name="entries" value="{{ request('entries') }}"></div>
        <select class="form-select" name="status">
            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
            <option value="sukses" {{ request('status') == 'sukses' ? 'selected' : '' }}>Sukses</option>
            <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
        <input type="date" class="form-control mx-1" placeholder="Created At" name="created_at" value="{{ request('created_at') }}">
        <input type="text" class="form-control mx-1" placeholder="Jumlah" name="jumlah" id="jumlah" value="{{ request('jumlah') }}">
        <input type="text" class="form-control mx-1" placeholder="Jenis" name="jenis" value="{{ request('jenis') }}">
        <input type="text" class="form-control mx-1" placeholder="Nama" name="user" value="{{ request('user') }}">

        <select class="form-select mx-1" name="order_by">
          <option value="">Urutkan Berdasarkan</option>
          <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Tanggal Dibuat</option>
          <option value="jumlah" {{ request('order_by') == 'jumlah' ? 'selected' : '' }}>Jumlah</option>
          <option value="jenis" {{ request('order_by') == 'jenis' ? 'selected' : '' }}>Jenis</option>
          <!-- Tambahkan opsi pengurutan lainnya sesuai kebutuhan -->
        </select>
        <select class="form-select mx-1" name="order_dir">
            <option value="asc" {{ request('order_dir') == 'asc' ? 'selected' : '' }}>Menaik</option>
            <option value="desc" {{ request('order_dir') == 'desc' ? 'selected' : '' }}>Menurun</option>
        </select>

        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
    </div>

    </form>
  </div>
</div>
@if(count($transactions) > 0)
    <div class="table-responsive small col-md-8">
      <table class="table table-striped table-sm">
        <tbody>
          @foreach($transactions as $transaksi)
          <tr>
            @if ($transaksi->operasi === 'kurang')
            <td><i class="bi bi-arrow-left-square-fill" style="color: #ff0000;"></i></td>
            @else
            <td><i class="bi bi-arrow-right-square-fill" style="color: #0dff00;"></i></td>  
            @endif
            <td>{{ $transaksi->jenis }}</td>
            <td>Rp. {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
            @if ($transaksi->status === 'sukses')
            <td><i class="bi bi-check-circle-fill" style="color: #0dff00;"></i></td>
            @elseif ($transaksi->status === 'gagal')
            <td><i class="bi bi-x-circle-fill" style="color: #ff0000;"></i></td>
            @else
            <td><i class="bi bi-clock-history" style="color: #000000;"></i></td>
            @endif
            <td>{{ $transaksi->user->name }}</td>
            <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>

            @if ($transaksi->status === 'pending')
            @if ($transaksi->jenis === 'Deposit')
            {{-- tes tes pop up --}}
            <td><button class="btn btn-secondary" onclick="openPopup({{ $transaksi->id }})">Bukti</button></td>
            <div class="overlay"></div>
            <div id="popup-{{ $transaksi->id }}" class="popup">
                <div class="popup-content">
                    <!-- Konten pop-up, seperti komentar -->
                    {{-- <p>Ini adalah komentar.</p> --}}
                    <img src="{{ asset('storage/' . $transaksi->payment_proof) }}" alt="" style="max-height: 500px; max-width: 500px;">
                    <br>
                    <br>
                    <button class="btn btn-secondary" onclick="closePopup({{ $transaksi->id }})">Tutup</button>
                </div>
            </div>
            {{-- end tes tes --}}
            @endif
            <td>
              <form action="/dashboard/confirm/{{ $transaksi->id }}" method="post" class="d-inline">
                @csrf
                <button class="btn btn-info" onclick="return confirm('Validasi Transaksi?')">Validasi</button>
              </form>
            </td>
            <td>
              <form action="/dashboard/deposit/cancel/{{ $transaksi->id }}" method="post" class="d-inline">  
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Gagalkan Transaksi?')">Cancel</button>
              </form>
            </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@else
  <p>Tidak ada riwayat transaksi.</p>
@endif

<script>
  function openPopup(gambarId) {
      // Menampilkan overlay dan popup
      document.querySelector('.overlay').style.display = 'block';
      document.getElementById('popup-' + gambarId).style.display = 'block';
  }

  function closePopup(gambarId) {
      // Menyembunyikan overlay dan popup
      document.querySelector('.overlay').style.display = 'none';
      document.getElementById('popup-' + gambarId).style.display = 'none';
  }

  var jumlah = document.getElementById('jumlah');
    jumlah.addEventListener('keyup', function(e)
    {
        jumlah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);   
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>