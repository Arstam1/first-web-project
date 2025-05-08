@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pengajuan Passport</h1>    
</div>
    <h2>Harap lengkapi data-data yang diperlukan</h2>
<div class="col-lg-8">
    <form method="post" action="/uploadreq" enctype="multipart/form-data" class="mb-3">
        @csrf
        <input type="hidden" class="form-control" id="transaksi" name="transaksi" required value="{{ $transaksi->id }}">
        <input type="hidden" class="form-control" id="harga" name="harga" required value="{{ $transaksi->total_harga }}">
        <input type="hidden" class="form-control" id="jumlah" name="jumlah" required value="500000">
        <div class="mb-3">
            <label for="ktp" class="form-label">Foto KTP</label>
            <input type="hidden" name="oldktp" value="{{ $transaksi->ktp }}">
            @if ($transaksi->ktp)
            <img src="{{ asset('storage/' . $transaksi->ktp) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('ktp') is-invalid @enderror" type="file" id="ktp" name="ktp" onchange="previewImage('ktp')">
            @error('ktp')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kk" class="form-label">Foto Kartu Keluarga</label>
            <input type="hidden" name="oldkk" value="{{ $transaksi->kk }}">
            @if ($transaksi->kk)
            <img src="{{ asset('storage/' . $transaksi->kk) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('kk') is-invalid @enderror" type="file" id="kk" name="kk" onchange="previewImage('kk')">
            @error('kk')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="akta" class="form-label">Foto Akta Kelahiran/Ijazah Pertama</label>
            <input type="hidden" name="oldakta" value="{{ $transaksi->akta }}">
            @if ($transaksi->akta)
            <img src="{{ asset('storage/' . $transaksi->akta) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('akta') is-invalid @enderror" type="file" id="akta" name="akta" onchange="previewImage('akta')">
            @error('akta')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>

<script>
    function previewImage(inputId) {
        const input = document.querySelector('#' + inputId);
        const imgPreview = input.parentElement.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function(event) {
            imgPreview.src = event.target.result;
        }
    }
</script>
@endsection