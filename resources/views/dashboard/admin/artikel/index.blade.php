@extends('dashboard.layouts.main')
@section('container')

<style>
    .card-img-top {
    width: 100%; /* Mengatur lebar gambar agar sesuai dengan container */
    height: 200px; /* Tetapkan tinggi gambar */
    object-fit: cover; /* Mencrop gambar agar sesuai dengan ukuran yang ditentukan */
    border-radius: 10px; /* Membuat sudut-sudut gambar menjadi bulat */
}
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Artikel AWM Tour</h1>
</div>
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif


<div class="container">
    <a href="/dashboard/artikel/create" class="btn btn-primary mb-3">Tambah artikel</a>
    <div class="row row-cols-1 row-cols-lg-4 text-left m-auto">
        @foreach ($artikel as $artikel)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title"> <span style="color:darkblue">{{ $artikel->judul }}</span></h5>
                    <h6><strong><span style="font-weight: bold; color:rgb(3, 2, 47)"></span>{!! substr($artikel->body, 0, 100) !!} .....</strong></h6>
                    <a href="/dashboard/artikel/{{ $artikel->slug }}" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                    <a href="/dashboard/artikel/{{ $artikel->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                    <form action="/dashboard/artikel/{{ $artikel->slug }}" method="post" class="d-inline">  
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0" onclick="return confirm('Hapus artikel?')"><i class="bi bi-trash-fill"></i></button>                    
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection