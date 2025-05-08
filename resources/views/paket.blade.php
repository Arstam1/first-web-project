@extends('layouts.main')
<style>
  .card-img-top {
  width: 100%; /* Mengatur lebar gambar agar sesuai dengan container */
  height: 200px; /* Tetapkan tinggi gambar */
  object-fit: cover; /* Mencrop gambar agar sesuai dengan ukuran yang ditentukan */
  border-radius: 10px; /* Membuat sudut-sudut gambar menjadi bulat */
}
</style>
@section('halamang')    
    <!-- hero-->
      <section id="hero">
        <div class="container text py-5"> 
            <div class="text-super-besar barlow text-putih fw-bold mb-2">NIKMATI PELAYANAN KAMI</div>  
              <div class="text-normal nunito text-putih mb-5">  
              Travel umrah terpercaya yang telah memberangkatkan para jamaah   
              <br /> 
              Haji dan  Umrah
            </div>
          </div>
      </section>
    <!-- end hero-->
   <!-- Offer-->
  <section id="offers" class="py-5">
    <div class="container">
      <div class="row row-cols-1 row-cols-lg-4 text-left">
        @foreach ($pakets  as $paket)
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
                    <a href="/paket/{{ $paket->slug }}" class="btn btn-info"><i class="bi bi-eye-fill"></i> Detail</a>
                    <a href="/dashboard/pakets/{{ $paket->slug }}/booking"><button class="btn btn-warning"><i class="bi bi-airplane-fill"></i> Booking</button></a>
                </div>
            </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- end Offer-->
  @endsection