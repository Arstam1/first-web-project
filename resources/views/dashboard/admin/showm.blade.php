@extends('dashboard.layouts.main')
@section('container')
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
  
  .popup1 {
    display: none; /* Mulai tersembunyi */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    z-index: 1000; /* Z-index yang lebih tinggi dari overlay */
  }

  .popup2 {
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
    <h1 class="h2">Member : {{ $member->user->name }}</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif

<div class="container">
  <div class="row row-cols-2 row-cols-lg-2 ptext-left m-auto">
  <div class="col">
    <div class="card">
      <div class="card-header">
        Data Diri
      </div>
      <div class="card-body">
        <table>
          <tr>
            <td><h6>Data Diri</h6></td>
          </tr>
          <tr>
            <td>No. KTP</td>
            <td>: {{ $member->ktp }}</td>
          </tr>
          <tr>
            <td>Nama </td>
            <td>: {{ $member->name }}</td>
          </tr>
          <tr>
            <td>Jenis Kelamin </td>
            <td>: {{ $member->jenis_kelamin }}</td>
          </tr>
          <tr>
            <td>Tempat Lahir </td>
            <td>: {{ $member->tempat_lahir }}</td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>: {{ $member->tgl_lahir }}</td>
          </tr>
          <tr>
            <td>Alamat </td>
            <td>: {{ $member->alamat }}</td>
          </tr>
          <tr>
            <td>RT </td>
            <td>: {{ $member->RT }}</td>
          </tr>
          <tr>
            <td>RW </td>
            <td>: {{ $member->RW }}</td>
          </tr>
          <tr>
            <td>Kelurahan </td>
            <td>: {{ $member->kelurahan }}</td>
          </tr>
          <tr>
            <td>Kecamatan </td>
            <td>: {{ $member->kecamatan }}</td>
          </tr>
          <tr>
            <td>Kota </td>
            <td>: {{ $member->kota }}</td>
          </tr>
          <tr>
            <td>Provinsi </td>
            <td>: {{ $member->proponsi }}</td>
          </tr>
          <tr>
            <td>No. HP </td>
            <td>: {{ $member->hp }}</td>
          </tr>
          <tr>
            <td>Pendidikan Terakhir </td>
            <td>: {{ $member->last_edu }}</td>
          </tr>
          <tr>
            <td>Pekerjaan </td>
            <td>: {{ $member->pekerjaan }}</td>
          </tr>
          <tr>
            <td><h6>Data Keluarga</h6></td>
          </tr>
          <tr>
            <td>Nama Keluarga </td>
            <td>: {{ $member->nama_darurat }}</td>
          </tr>
          <tr>
            <td>Alamat Keluarga </td>
            <td>: {{ $member->alamat_darurat }}</td>
          </tr>
          <tr>
            <td>Kontak Keluarga</td>
            <td>: {{ $member->kontak_darurat }}</td>
          </tr>
          <tr>
            <td>No. Passport</td>
            <td>: {{ $member->no_passport }}</td>
          </tr>
          <tr>
            <td>D. Issue</td>
            <td>: {{ $member->dissue }}</td>
          </tr>
          <tr>
            <td>D. Expiry</td>
            <td>: {{ $member->dexpiry }}</td>
          </tr>
          <tr>
            <td>Issuing Office</td>
            <td>: {{ $member->issuing_office }}</td>
          </tr>
        </table>
        <p>Edited By : {{ $member->edited_by }}</p>

        <a href="/dashboard/member/{{ $member->user->email }}/formulir" class="btn btn-warning"> <i class="bi bi-pencil-fill"></i> Edit</a>
      </div>
    </div>
  </div>
</div>

<div class="col mt-4">
  <div class="card">
    <div class="card-header">
      Kelengkapan Dokumen
    </div>
    <div class="card-body">
      @if (!$dokumen->passport)
      <li>Passport Anda belum diunggah.</li>
      @else
      {{-- tes tes pop up --}}
      <button class="btn btn-secondary" onclick="openPopup1()">Passport</button>
      <div class="overlay"></div>
      <div id="popup1" class="popup1">
          <div class="popup-content">
              <!-- Konten pop-up, seperti komentar -->
              {{-- <p>Ini adalah komentar.</p> --}}
              <img src="{{ asset('storage/' . $dokumen->passport) }}" alt="" style="max-height: 500px; max-width: 500px;">
              <br>
              <br>
              <button class="btn btn-secondary" onclick="closePopup1()">Tutup</button>
          </div>
      </div>
      {{-- end tes tes --}}
      @endif
      @if (!$dokumen->foto46)
      <li>Pas Foto anda belum diunggah</li>
      @else
      <button class="btn btn-secondary" onclick="openPopup2()">Pas Foto</button>
      <div class="overlay"></div>
      <div id="popup2" class="popup2">
          <div class="popup-content">
              <!-- Konten pop-up, seperti komentar -->
              {{-- <p>Ini adalah komentar.</p> --}}
              <img src="{{ asset('storage/' . $dokumen->foto46) }}" alt="" style="max-height: 500px; max-width: 500px;">
              <br>
              <br>
              <button class="btn btn-secondary" onclick="closePopup2()">Tutup</button>
          </div>
      </div>
      @endif
      <br>
      <p>Last Updated By {{ $member->edited_by }}</p>
      <a href="/dashboard/member/{{ $member->user->email }}/dokumen" class="btn btn-info"> <i class="bi bi-pencil-fill"></i>   Mohon Lengkapi Dokumen Anda</a>
    </div>
</div>

</div>

<script>
  function openPopup1() {
    document.querySelector('.overlay').style.display = 'block';
    document.querySelector('.popup1').style.display = 'block';
  }
  function closePopup1() {
    document.querySelector('.overlay').style.display = 'none';
    document.querySelector('.popup1').style.display = 'none';
  }

  function openPopup2() {
    document.querySelector('.overlay').style.display = 'block';
    document.querySelector('.popup2').style.display = 'block';
  }
  function closePopup2() {
    document.querySelector('.overlay').style.display = 'none';
    document.querySelector('.popup2').style.display = 'none';
  }

</script>

@endsection