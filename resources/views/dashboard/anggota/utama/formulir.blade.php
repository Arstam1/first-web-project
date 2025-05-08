@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Formulir Data Diri</h1>    
</div>
    
<div class="col-lg-8">
    <form method="post" action="/konfirmasiform" enctype="multipart/form-data" class="mb-3">
        @csrf
        <h4>Data Diri</h4>
        <div class="mb-3">
            <label for="ktp" class="form-label">Nomor KTP</label>
            <input type="number" class="form-control @error('ktp') is-invalid @enderror" id="ktp" name="ktp" utofocus value="{{ old('ktp')  ?? $member->ktp }}">
            @error('ktp')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $member->name}}">
          @error('name')
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="hp" class="form-label">Nomor Telpon/Handphone</label>
            <input type="number" class="form-control @error('hp') is-invalid @enderror" id="hp" name="hp" min="0" value="{{ old('hp') ?? $member->hp}}">
             @error('hp')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') ?? $member->tempat_lahir}}">
             @error('tempat_lahir')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') ?? $member->tgl_lahir}}">
             @error('tgl_lahir')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin">
                <option value="Laki-laki" selected>Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') ?? $member->alamat}}">
             @error('alamat')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="RT" class="form-label">RT</label>
            <input type="number" class="form-control @error('RT') is-invalid @enderror" id="RT" name="RT" value="{{ old('RT') ?? $member->RT}}">
            @error('RT')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
        </div>
        <div class="mb-3">
            <label for="RW" class="form-label">RW</label>
            <input type="number" class="form-control @error('RW') is-invalid @enderror" id="RW" name="RW" value="{{ old('RW') ?? $member->RW}}">
            @error('RW')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
        </div>
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') ?? $member->kecamatan}}">
            @error('kecamatan')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
        </div>
        <div class="mb-3">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') ?? $member->kelurahan}}">
            @error('kelurahan')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota" value="{{ old('kota') ?? $member->kota}}">
            @error('kota')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="proponsi" class="form-label">Provinsi</label>
            <input type="text" class="form-control @error('proponsi') is-invalid @enderror" id="proponsi" name="proponsi" value="{{ old('proponsi') ?? $member->proponsi}}">
            @error('proponsi')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_edu" class="form-label">Pendidikan Terakhir</label>
            <input type="text" class="form-control @error('last_edu') is-invalid @enderror" id="last_edu" name="last_edu" value="{{ old('last_edu') ?? $member->last_edu}}">
            @error('last_edu')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') ?? $member->pekerjaan}}">
            @error('pekerjaan')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
        </div>
        <h4>Data Keluarga Yang Dapat Dihubungi Di Indonesia</h4>
        <div class="mb-3">
            <label for="nama_darurat" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('nama_darurat') is-invalid @enderror" id="nama_darurat" name="nama_darurat" value="{{ old('nama_darurat') ?? $member->nama_darurat}}">
            @error('nama_darurat')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="alamat_darurat" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('alamat_darurat') is-invalid @enderror" id="alamat_darurat" name="alamat_darurat" value="{{ old('alamat_darurat') ?? $member->alamat_darurat}}">
            @error('alamat_darurat')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kontak_darurat" class="form-label">No. Hp</label>
            <input type="text" class="form-control @error('kontak_darurat') is-invalid @enderror" id="kontak_darurat" name="kontak_darurat" value="{{ old('kontak_darurat') ?? $member->kontak_darurat}}">
            @error('kontak_darurat')      
              <div id="validationServerUsernameFeedback" class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
        </div>
        <h4>Data Passport</h4>
        <div class="mb-3">
          <label for="no_passport" class="form-label">No. Passport</label>
          <input type="text" class="form-control @error('no_passport') is-invalid @enderror" id="no_passport" name="no_passport" value="{{ old('no_passport') ?? $member->no_passport}}">
          @error('no_passport')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="dissue" class="form-label">D. Issue</label>
          <input type="date" class="form-control @error('dissue') is-invalid @enderror" id="dissue" name="dissue" value="{{ old('dissue') ?? $member->dissue}}">
          @error('dissue')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="dexpiry" class="form-label">D. Expiry</label>
          <input type="date" class="form-control @error('dexpiry') is-invalid @enderror" id="dexpiry" name="dexpiry" value="{{ old('dexpiry') ?? $member->dexpiry}}">
          @error('dexpiry')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="issuing_office" class="form-label">Issuing Office</label>
          <input type="text" class="form-control @error('issuing_office') is-invalid @enderror" id="issuing_office" name="issuing_office" value="{{ old('issuing_office') ?? $member->issuing_office}}">
          @error('issuing_office')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection