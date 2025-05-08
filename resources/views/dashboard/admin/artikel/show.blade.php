@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Artikel AWM Tour</h1>    
</div>
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $artikel->judul }}</h1>
            <img src="{{ asset('storage/' . $artikel->gambar) }}" width="600" height="800" alt="">
            {!! $artikel->body !!}
        </div>
    </div>
</div>
@endsection