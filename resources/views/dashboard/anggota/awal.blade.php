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

.card {
    width: 700px;
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
  <h1 class="h2">Selamat Datang, {{ auth()->user()->name }}</h1>
</div>
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show col-lg-8" role="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif

{{-- @if(($transaksi && $transaksi->status_berangkat !== 'batal') && ((($transaksi->status_pelunasan === 'belum lunas' && $transaksi->status_berangkat == 'belum berangkat') || $ceknul->exists()) || $ceknul2->exists()) && $beda >= 21)
@php
// Menghitung tanggal tujuh hari sebelum tanggal berangkat
$h21 = date('Y-m-d', strtotime('-21 days', strtotime($transaksi->paket->tanggal_berangkat)));
$selisihHari = (strtotime($h21) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
@endphp
<p class="text text-danger">Batas waktu pelunasan dan pengumpulan berkas : {{ $selisihHari }} hari</p>
@endif  --}}

@if($transaksi && $transaksi->status_berangkat !== 'batal' && 
    (
        ($transaksi->status_pelunasan === 'belum lunas' && $transaksi->status_berangkat == 'belum berangkat') || 
        ($ceknul->exists() || $ceknul2->exists())
    ) && 
    $beda >= 21)
    @php
        // Pastikan tanggal berangkat tidak kosong
        if (!empty($transaksi->paket->tanggal_berangkat)) {
            $h21 = date('Y-m-d', strtotime('-21 days', strtotime($transaksi->paket->tanggal_berangkat)));
            $selisihHari = (strtotime($h21) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
        } else {
            $selisihHari = null;
        }
    @endphp
    @if(!is_null($selisihHari))
        <p class="text text-danger">Batas waktu pelunasan dan pengumpulan berkas : {{ $selisihHari }} hari</p>
    @endif
@endif


{{-- && is_null($member --}}


<div class="container">
  <div class="row row-cols-2 row-cols-lg-2 ptext-left m-auto">
    <div class="col">
      <div class="card">
        <div class="card-header">
          Profil
        </div>
        <div class="card-body">
          <table>
            <tr>
              <td><h5>Nama</h5></td>
              <td><h5>: <strong>{{ $user->name }}</strong></h5></td>
            </tr>
            <tr>
              <td><h5>Email</h5> </td>
              <td><h5>: <strong>{{ $user->email }}</strong></h5></td>
            </tr>
            <tr>
              <td><h5>Password</h5></td>
              <td><h5>: </strong>****** </strong></h5></td>
            </tr>
          </table>
          <a href="/dashboard/{{ auth()->user()->email }}" class="btn btn-warning"> <i class="bi bi-pencil-fill"></i> Edit</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col mt-4">
    <div class="card">
      <div class="card-header">
        Pesanan Saya
      </div>
      <div class="card-body">
        <div>
        @if($transaksi && ($transaksi->status_berangkat === 'belum berangkat' || $transaksi->status_berangkat === 'dalam perjalanan'))
            <div class="col">
              <div style="line-height: 1; ">
              {{-- @if ($transaksi && $deposit->status === 'pending')
              <h1>Harap Tunggu! Transaksi Anda sedang divalidasi</h1>
              @endif --}}
              <h1><strong class="text text-primary">{{ $transaksi->paket->nama }}</strong></h1>
              <h2><strong style="color:rgb(5, 136, 55)"> {{ date('j F Y', strtotime($transaksi->paket->tanggal_berangkat)) }} </strong></h2>
              <table>
                <tbody>
                  <tr>
                    <td>Total Harga</td>
                    <td>: <strong style="color:rgb(0, 46, 87)">Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></td>
                  </tr>
                  <tr>
                    <td><p>Rincian</p></td>
                    <td>: </td>
                  </tr>
                  @if ($transaksi->pengajuan_passport === 'iya')
                  <tr>
                    <td><li>Harga Paket </li></td>
                    <td>: Rp. {{ number_format($transaksi->paket->harga, 0, ',', '.') }}</td>
                  </tr>
                  <br>
                  <tr>
                    <td><li>Tipe Kamar</li></td>
                    <td>: {{ $transaksi->tipe_kamar }} (Rp. {{ number_format($transaksi->total_harga - $transaksi->paket->harga - 500000, 0, ',', '.') }})</td>
                  </tr>
                    <br>
                  <tr>
                    <td><li>Pembuatan Passport</li></td>
                    <td>: Rp. 500.000 </td>
                  </tr>
                  @else
                  <tr>
                    <td><li>Harga Paket </li></td>
                    <td>: Rp. {{ number_format($transaksi->paket->harga, 0, ',', '.') }}</td>
                  </tr>
                  <tr>
                    <td><li>Tipe Kamar</li></td>
                    <td>: {{ $transaksi->tipe_kamar }} (Rp. {{ number_format($transaksi->total_harga - $transaksi->paket->harga, 0, ',', '.') }})</td>
                  </tr>
                  @endif

                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><p>Total setoran</p></td>
                    <td><p>: <strong class="text text-success">Rp. {{ number_format($transaksi->jumlah, 0, ',', '.') }}</strong></p></td>
                  </tr>
                  @if ($transaksi->jumlah !== $transaksi->total_harga)
                  <tr>
                    <td><p>Sisa pembayaran</p></td>
                    <td><p>: <strong class="text text-success">Rp. {{ number_format($transaksi->total_harga - $transaksi->jumlah, 0, ',', '.') }}</strong></p></td>
                  </tr>
                  @endif
                  @if ($transaksi->status_pelunasan !== 'lunas')
                  <tr>
                    <td><p>Status Pelunasan</p></td>
                    <td>: <strong class="text text-danger">{{ strtoupper($transaksi->status_pelunasan) }}</strong></td>
                  </tr>
                  @else
                  <tr>
                    <td><p>Status Pelunasan</td>
                    <td>: <strong class="text text-success">{{ strtoupper($transaksi->status_pelunasan) }}</strong></p></td>
                  </tr>
                  @endif
                  <tr>
                    <td><p>Status Keberangkatan </p></td>
                    <td>: <strong class="text text-primary">{{ strtoupper($transaksi->status_berangkat) }}</strong></td>
                  </tr>
                </tbody>
              </table>
              </div>
              @if ($transaksi->pengajuan_passport === 'tidak')
              *Belum punya passport? <a href="/dashboard/passport_req/{{ $transaksi->id }}">Ajukan disini</a>
              @endif

              @if ($transaksi->pengajuan_passport === 'iya' && (!$transaksi->ktp || !$transaksi->kk || !$transaksi->akta) )
              *Lengkapi berkas pengajuan passport <a href="/dashboard/passport_req/{{ $transaksi->id }}">di sini</a>
              @endif
            </div>
            <div class="col mt-4">

              {{-- tes tes pop up --}}
              <button class="btn btn-secondary" onclick="openPopup('poster')">Tampilkan Gambar</button>
              <div class="overlay"></div>
              <div id="popup-poster" class="popup">
                  <div class="popup-content">
                      <!-- Konten pop-up, seperti komentar -->
                      {{-- <p>Ini adalah komentar.</p> --}}
                      <img src="{{ asset('storage/' . $transaksi->paket->gambar) }}" alt="" style="max-height: 500px; max-width: 500px;">
                      <br>
                      <br>
                      <button class="btn btn-secondary" onclick="closePopup('poster')">Tutup</button>
                  </div>
              </div>
              {{-- end tes tes --}}

            </div>
            <br>
            @if ($deposit1)
            <h6>Menunggu konfirmasi pembatalan dari admin</h6>
            @else
            <form action="/dashboard/cancel/{{ $transaksi->id }}" method="post" class="d-inline">  
              @csrf
              <button class="btn btn-danger" onclick="return confirm('Batalkan Pesanan?')">Batalkan</button>
            </form>
            @endif
            @if ($transaksi->status_pelunasan === 'belum lunas')
            <a href="/dashboard/pembayaran/{{ $transaksi->id }}"><button class="btn btn-primary">Pelunasan</button></a>
            @endif
        @else
        <i class="bi bi-emoji-frown-fill" style="height: 100; width: 100"></i>
            <p>Belum ada pesanan</p>                   
            <a href="/dashboard/pakets" class="btn btn-info"> <i class="bi bi-pencil-fill"></i> Pesan Sekarang</a>
        @endif
            <br>
            <br>
            <a href="/dashboard/riwayat_paket" class="text-dark"> Riwayat Pemesanan Paket</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col mt-4">
    <div class="card">
      <div class="card-header">
        Kelengkapan data Profil
      </div>
      <div class="card-body">
        @if (!$member->ktp)
        <li>NIK Anda belum diisi.</li>
        @endif
        @if (!$member->name)
        <li>Nama Anda belum diisi.</li>
        @endif
        @if (!$member->jenis_kelamin)
            <li>Jenis Kelamin Anda belum diisi.</li>
        @endif
        @if (!$member->tempat_lahir)
            <li>Tempat Lahir Anda belum diisi.</li>
        @endif
        @if (!$member->RT)
            <li>Nomor RT Anda belum diisi.</li>
        @endif
        @if (!$member->RW)
            <li>Nomor RW Anda belum diisi.</li>
        @endif
        @if (!$member->kelurahan)
            <li>Kelurahan Anda belum diisi.</li>
        @endif
        @if (!$member->kecamatan)
            <li>Kecamatan Anda belum diisi.</li>
        @endif
        @if (!$member->kota)
            <li>Kota Anda belum diisi.</li>
        @endif
        @if (!$member->proponsi)
            <li>Provinsi Anda belum diisi.</li>
        @endif
        @if (!$member->hp)
            <li>No hp Anda belum diisi.</li>
        @endif
        @if (!$member->last_edu)
            <li>Pendidikan Terakhir Anda belum diisi.</li>
        @endif
        @if (!$member->pekerjaan)
            <li>Pekerjaan Anda belum diisi.</li>
        @endif
        @if (!$member->nama_darurat)
            <li>Nama keluarga Anda belum diisi.</li>
        @endif
        @if (!$member->kontak_darurat)
            <li>Kontak Keluarga Anda belum diisi.</li>
        @endif
        @if (!$member->alamat_darurat)
            <li>Alamat Keluarga Anda belum diisi.</li>
        @endif
        @if (!$member->no_passport)
            <li>No. Passport Anda belum diisi.</li>
        @endif
        @if (!$member->dissue)
            <li>D. Issue Passport belum diisi.</li>
        @endif
        @if (!$member->dexpiry)
            <li>D. Expiry Passport belum diisi.</li>
        @endif
        @if (!$member->issuing_office)
            <li>Issuing Office Passport belum diisi.</li>
        @endif
        <br>
        <p>Last Updated By {{ $member->edited_by }}</p>
        <a href="/dashboard/formulir" class="btn btn-info"> <i class="bi bi-pencil-fill"></i>   Mohon Lengkapi Data Anda</a>
      </div>
  </div>
</div>

<div class="col mt-4">
    <div class="card">
      <div class="card-header">
        Kelengkapan Dokumen
      </div>
      <div class="card-body">
        @if (!$dokumens->passport)
      <li>Passport Anda belum diunggah.</li>
      @else
      {{-- tes tes pop up --}}
      <button class="btn btn-secondary" onclick="openPopup('pass')">Passport</button>
      <div class="overlay"></div>
      <div id="popup-pass" class="popup">
          <div class="popup-content">
              <!-- Konten pop-up, seperti komentar -->
              {{-- <p>Ini adalah komentar.</p> --}}
              <img src="{{ asset('storage/' . $dokumens->passport) }}" alt="" style="max-height: 500px; max-width: 500px;">
              <br>
              <br>
              <button class="btn btn-secondary" onclick="closePopup('pass')">Tutup</button>
          </div>
      </div>
      {{-- end tes tes --}}
      @endif
      @if (!$dokumens->foto46)
      <li>Pas Foto anda belum diunggah</li>
      @else
      <button class="btn btn-secondary" onclick="openPopup('foto')">Pas Foto</button>
      <div class="overlay"></div>
      <div id="popup-foto" class="popup">
          <div class="popup-content">
              <!-- Konten pop-up, seperti komentar -->
              {{-- <p>Ini adalah komentar.</p> --}}
              <img src="{{ asset('storage/' . $dokumens->foto46) }}" alt="" style="max-height: 500px; max-width: 500px;">
              <br>
              <br>
              <button class="btn btn-secondary" onclick="closePopup('foto')">Tutup</button>
          </div>
      </div>
      @endif
        <br>
        <p>Last Updated By {{ $dokumens->edited_by }}</p>
        <a href="/dashboard/dokumen" class="btn btn-info"> <i class="bi bi-pencil-fill"></i>   Mohon Lengkapi Dokumen Anda</a>
      </div>
  </div>
</div>

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
</script>

{{-- <script>
function openPopup() {
  document.querySelector('.overlay').style.display = 'block';
  document.querySelector('.popup').style.display = 'block';
}
function closePopup() {
  document.querySelector('.overlay').style.display = 'none';
  document.querySelector('.popup').style.display = 'none';
}
</script> --}}

{{-- <button type="button" class="btn basic-info-btn mt-0 btn-outline-light btn-block">
  <div class="row align-items-center">
    <div class="col col-4">
      <p class="text-muted mb-0">Nama</p>
    </div> 
    <div class="flex-grow-1 pl-0 col">
      <p class="mb-0">AHMAD  RIQAS</p>
    </div> 
    <div  class="flex-grow-0 col">
      <i class="bi bi-eye-fill"></i>
    </div>
  </div>
</button> --}}

{{-- @foreach ($dokumens as $dokumen)
    @if ($dokumen->record == is_null)
        <p>{{ $dokumen->record }} anda belum terisi</p>
    @endif
@endforeach --}}