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
    <h1 class="h2">Paket AWM Tour</h1>    
</div>
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif


<div class="container">
    @if (auth()->user()->is_admin)
    <a href="/dashboard/pakets/create" class="btn btn-primary mb-3">Tambah Paket</a>
    @endif
    <div class="row row-cols-1 row-cols-lg-4 text-left m-auto">
        @foreach ($pakets as $paket)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $paket->gambar) }}" class="card-img-top" alt="">
                <div class="card-body">
                    <h4><strong><span style="color:rgb(7, 40, 70)">{{ $paket->kategori->kategori }}</span></strong></h4>
                    <h5 class="card-title"> <span style="color:darkblue">{{ $paket->nama }}</span></h5>
                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                    <h5><strong><span style="font-weight: bold; color:rgb(11, 75, 1)">  Rp. {{ number_format($paket->harga, 0, ',', '.') }}/ pax  </span></strong></h5>
                    <h6><strong><span style="font-weight: bold; color:rgb(3, 2, 47)"> {{ date('j F Y', strtotime($paket->tanggal_berangkat)) }}</span></strong></h6>
                    <h6>Durasi Paket ({{ $paket->durasi }})</h6>
                    <h6>Available Seat ({{ $paket->seat }})</h6>
                    @if (auth()->user()->is_admin)
                    <a href="/dashboard/pakets/{{ $paket->slug }}" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                    <a href="/dashboard/pakets/{{ $paket->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                    <form action="/dashboard/pakets/{{ $paket->slug }}" method="post" class="d-inline">  
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0" onclick="return confirm('Hapus paket?')"><i class="bi bi-trash-fill"></i></button>                    
                    </form>      
                    @else
                    <a href="/dashboard/pakets/{{ $paket->slug }}" class="btn btn-info"><i class="bi bi-eye-fill"></i> Detail</a>
                    <a href="/dashboard/pakets/{{ $paket->slug }}/booking"><button class="btn btn-warning"><i class="bi bi-airplane-fill"></i> Booking</button></a>
                    @endif
                  
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection