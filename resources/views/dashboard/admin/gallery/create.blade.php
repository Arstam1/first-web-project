@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Upload Gambar</h1>
</div>
    
<div class="col-lg-8">
    <form method="post" action="/dashboard/gallery" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required autofocus value="{{ old('keterangan') }}">
          @error('keterangan')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
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
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<script>
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
</script>
@endsection