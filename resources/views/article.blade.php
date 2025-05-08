@extends('layouts.main')
@section('halamang')
<style>
  .card-img-top {
  width: 100%; /* Mengatur lebar gambar agar sesuai dengan container */
  height: 200px; /* Tetapkan tinggi gambar */
  object-fit: cover; /* Mencrop gambar agar sesuai dengan ukuran yang ditentukan */
  border-radius: 10px; /* Membuat sudut-sudut gambar menjadi bulat */
}
</style>
<!-- hero-->
<section id="hero">
  <div class="container text py-5"> 
      <div class="text-super-besar barlow text-putih fw-bold mb-2">ARTIKEL</div>  
        <div class="text-normal nunito text-putih mb-5">  
          Jangan Sampai Ketinggalan Dengan Artikel Terbaru Kami  
        <br/>  
      </div>
  </div>
</section>
<!-- end hero-->
<!-- Article -->
<div class="container mt-4 mb-4">
  <div class="row row-cols-1 row-cols-lg-4 text-left m-auto">
      @foreach ($artikel as $artikel)
      <div class="col">
          <div class="card" style="width: 18rem; height: 25rem">
              <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top" alt="">
              <div class="card-body">
                  <h5 class="card-title"> <span style="color:darkblue">{{ $artikel->judul }}</span></h5>
                  <h6><strong><span style="font-weight: bold; color:rgb(3, 2, 47)"></span>{!! substr($artikel->body, 0, 100) !!} .....</strong></h6>
                  <a href="/article/{{ $artikel->slug }}" class="btn btn-info">Detail</a>
              </div>
          </div>
      </div>
      @endforeach
  </div>
</div>
<!-- End Article -->  
@endsection