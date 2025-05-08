@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Artikel Baru</h1>    
</div>
    
<div class="col-lg-8">
    <form method="post" action="/dashboard/artikel" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" required autofocus value="{{ old('judul') }}">
          @error('judul')
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
            <label for="body" class="form-label">Body</label>            
            @error('body')
            <p class="text-danger">{{ $message }}</p>    
            @enderror
            <input id="body" type="hidden" name="body" required value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Buat Artikel</button>
    </form>
</div>

<script>
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');
    judul.addEventListener('change', function(){
        fetch('/dashboard/artikel/checkSlug?judul=' + judul.value)
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
</script>
@endsection