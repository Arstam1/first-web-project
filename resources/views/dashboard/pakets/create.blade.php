@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Paket Baru</h1>    
</div>
    
<div class="col-lg-8">
    <form method="post" action="/dashboard/pakets" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama') }}">
          @error('nama')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
            @error('slug')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Tipe Room Quad</label>
            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" min="0" required value="{{ old('harga') }}">
             @error('harga')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="triple" class="form-label">Harga Tipe Room Triple</label>
            <input type="text" class="form-control @error('triple') is-invalid @enderror" id="triple" name="triple" min="0" value="{{ old('triple') }}">
             @error('triple')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="duo" class="form-label">Harga Tipe Room Duo</label>
            <input type="text" class="form-control @error('duo') is-invalid @enderror" id="duo" name="duo" min="0" value="{{ old('duo') }}">
             @error('duo')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="seat" class="form-label">Jumlah Seat</label>
            <input type="number" class="form-control @error('seat') is-invalid @enderror" id="seat" name="seat" min="0" required value="{{ old('seat') }}">
             @error('seat')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal_berangkat" class="form-label">Tanggal Pemberangkatan</label>
            <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" id="tanggal_berangkat" name="tanggal_berangkat" required value="{{ old('tanggal_berangkat') }}">
             @error('tanggal_berangkat')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label">Durasi</label>
            <input type="text" class="form-control @error('durasi') is-invalid @enderror" id="durasi" name="durasi" required value="{{ old('durasi') }}">
             @error('durasi')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">kategori</label>
            <select class="form-select" name="kategori_id">
                @foreach ($Kategoris as $kategori)
                @if (old('kategori_id') == $kategori->id)
                <option value="{{ $kategori->id }}" selected>{{ $kategori->kategori }}</option>
                @else
                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                @endif                    
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Poster</label>
            <img class="img-preview img-fluid mb-4 col-sm-6">
            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" onchange="previewGambar()">            
            @error('gambar')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
          </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>            
            @error('deskripsi')
            <p class="text-danger">{{ $message }}</p>    
            @enderror
            <input id="deskripsi" type="hidden" name="deskripsi" required value="{{ old('deskripsi') }}">
            <trix-editor input="deskripsi"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Buat Paket</button>
    </form>
</div>

<script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');
    nama.addEventListener('change', function(){
        fetch('/dashboard/pakets/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    })

    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })    
    function previewGambar() {
        const gambar = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const ofReader = new FileReader();
        ofReader.readAsDataURL(gambar.files[0]);
        ofReader.onload = function(ofREvent){
            imgPreview.src = ofREvent.target.result;
        }        
    }

    // format rupiah
    var harga = document.getElementById('harga');
    harga.addEventListener('keyup', function(e)
    {
        harga.value = formatRupiah(this.value, 'Rp. ');
    });

    var triple = document.getElementById('triple');
    triple.addEventListener('keyup', function(e)
    {
        triple.value = formatRupiah(this.value, 'Rp. ');
    });

    var duo = document.getElementById('duo');
    duo.addEventListener('keyup', function(e)
    {
        duo.value = formatRupiah(this.value, 'Rp. ');
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
    // end format rupiah
</script>
@endsection