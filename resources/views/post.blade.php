@extends('layouts.main')
@section('halamang')
{{-- <section id="hero">
    <div class="container text-center py-5"> 
        <div class="text-super-besar barlow text-hitam fw-bold mb-2">ARTIKEL</div>
          <div class="text-normal nunito text-hitam mb-5">
           Jangan Sampai Ketinggalan Dengan Artikel Terbaru Kami
          <br />
          </div>
    </div>
</section> --}}
<br>
<section style="padding-top: 100px;">
<div class="container mt-7">
    <div>
        <img src="{{ asset('storage/' . $artikel->gambar) }}" style="max-height: 500px; max-width:500px" alt="">
        <h1>
            {{ $artikel->judul }}
        </h1>
        <p>
            {!! $artikel->body !!}
        </p>
    </div>
</div>
</section>
@endsection