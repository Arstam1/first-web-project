@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelengkapan Dokumen</h1>    
</div>
    
<div class="col-lg-8">
    <form method="post" action="/isidoc" enctype="multipart/form-data" class="mb-3">
        @csrf
        <input type="hidden" name="email" id="email" value="{{ $dokumens->user->email }}">
        <div class="mb-3">
            <label for="passport" class="form-label">Foto Passport</label>
            <input type="hidden" name="oldpassport" value="{{ $dokumens->passport }}">
            @if ($dokumens->passport)
            <img src="{{ asset('storage/' . $dokumens->passport) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('passport') is-invalid @enderror" type="file" id="passport" name="passport" autofocus onchange="previewImage('passport')">
            @error('passport')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label for="ktp" class="form-label">Foto KTP</label>
            <input type="hidden" name="oldktp" value="{{ $dokumens->ktp }}">
            @if ($dokumens->ktp)
            <img src="{{ asset('storage/' . $dokumens->ktp) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('ktp') is-invalid @enderror" type="file" id="ktp" name="ktp" onchange="previewImage('ktp')">
            @error('ktp')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div> --}}
        {{-- <div class="mb-3">
            <label for="kk" class="form-label">Foto Kartu Keluarga</label>
            <input type="hidden" name="oldkk" value="{{ $dokumens->kk }}">
            @if ($dokumens->kk)
            <img src="{{ asset('storage/' . $dokumens->kk) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('kk') is-invalid @enderror" type="file" id="kk" name="kk" onchange="previewImage('kk')">
            @error('kk')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div> --}}
        {{-- <div class="mb-3">
            <label for="vaksin" class="form-label">Foto Vaksin</label>
            <input type="hidden" name="oldvaksin" value="{{ $dokumens->vaksin }}">
            @if ($dokumens->vaksin)
            <img src="{{ asset('storage/' . $dokumens->vaksin) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('vaksin') is-invalid @enderror" type="file" id="vaksin" name="vaksin" onchange="previewImage('vaksin')">
            @error('vaksin')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label for="foto46" class="form-label">Pas Foto 4x6</label>
            <input type="hidden" name="oldfoto46" value="{{ $dokumens->foto46 }}">
            @if ($dokumens->foto46)
            <img src="{{ asset('storage/' . $dokumens->foto46) }}" class="img-preview img-fluid mb-4 col-sm-6 d-block">
            @else
            <img class="img-preview img-fluid mb-4 col-sm-6">
            @endif
            <input class="form-control @error('foto46') is-invalid @enderror" type="file" id="foto46" name="foto46" onchange="previewImage('foto46')">
            @error('foto46')      
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>

<script>
    // function previewGambar() {
    //     const gambar = document.querySelector('#gambar');
    //     const imgPreview = document.querySelector('.img-preview');
    //     imgPreview.style.display = 'block';
    //     const ofReader = new FileReader();
    //     ofReader.readAsDataURL(gambar.files[0]);
    //     ofReader.onload = function(ofREvent){
    //         imgPreview.src = ofREvent.target.result;
    //     }        
    // }
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