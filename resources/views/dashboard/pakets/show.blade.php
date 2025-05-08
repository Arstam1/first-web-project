@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Paket AWM Tour</h1>    
</div>
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-8">
            @if (auth()->user()->is_admin == 0)
            <a href="/dashboard/pakets/{{ $paket->slug }}/booking"><button type="submit" class="btn btn-warning"><i class="bi bi-airplane-fill"></i> Booking Sekarang</button></a>
            @else
            <a href="/dashboard/pakets/{{ $paket->slug }}/pendaftar"><button type="submit" class="btn btn-info">Cek pendaftar</button></a>
            @endif
            <h1 class="mb-3">{{ $paket->nama }}</h1>
            <img src="{{ asset('storage/' . $paket->gambar) }}" width="600" height="800" alt="">
            {!! $paket->deskripsi !!}
        </div>
    </div>
</div>
@endsection