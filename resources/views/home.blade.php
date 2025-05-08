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
        <div class="container text-left py-5"> 
          <div class="text-super-besar barlow text-putih fw-bold mb-2">PT. Al Ikhlas Wisata Mandiri</div>
            <div class="text-normal nunito text-putih mb-5">
            Travel umrah terpercaya yang telah memberangkatkan para jamaah 
            <br />
            Haji dan  Umrah
          </div>
        </div>
      </section>
    <!-- end hero-->
  <!-- reviews-->
  {{-- <section id="reviews" class="py-5">
    <div class="container">
      <div class="row row-cols-2 row-cols-lg-5 text-center">
        <div class="col">
        <img src="img/google.png" height="50" alt="">
        <div class="d-flex justify-content-center">
          <img src="img/bintang.jpg" height="25" alt="">
          <p>4.8/5</p>
        </div>
        <p>14 reviews</p>
        </div>
        <div class="col">
            <img src="img/google.png" height="50" alt="">
            <div class="d-flex justify-content-center">
              <img src="img/bintang.jpg" height="25" alt="">
              <p>4.8/5</p>
            </div>
            <p>14 reviews</p>
        </div>
        <div class="col">
            <img src="img/google.png" height="50" alt="">
            <div class="d-flex justify-content-center">
              <img src="img/bintang.jpg" height="25" alt="">
              <p>4.8/5</p>
            </div>
            <p>14 reviews</p>
        </div>
        <div class="col">
            <img src="img/google.png" height="50" alt="">
            <div class="d-flex justify-content-center">
              <img src="img/bintang.jpg" height="25" alt="">
              <p>4.8/5</p>
            </div>
            <p>14 reviews</p>
        </div>
        <div class="col">
            <img src="img/google.png" height="50" alt="">
            <div class="d-flex justify-content-center">
              <img src="img/bintang.jpg" height="25" alt="">
              <p>4.8/5</p>
            </div>
            <p>14 reviews</p>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- End reviews-->
  <!-- Offer-->
  <section id="offers" class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        @if ($paket)
        <div class="text-besar barlow text-hitam fw-bold">
          Haji dan Umrah Special Offers
      </div>
      <div class="text-normal nunito">
          Jangan tinggal kan penawaran istimewa dari kami
      </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-4 text-left">
      @foreach ($paket as $paket)
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
        @else
        <div class="text-besar barlow text-hitam fw-bold">
          COMING SOON!
      </div>
        @endif
        
      </div>
    </div>
  </section>
  <!-- Offer-->
  <!-- services -->>
  <section id="services" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="text-besar barlow text-hitam fw-bold mb-2"> Mengapa harus memilih kami?
            {{-- <div class="text-normal nunito mb-5"> Al Ikhlas Wisata Mandiri menawarkan fasilitas haji dan umrah dengan harga terjangkau, menjadikan perjalanan Anda fokus pada ibadah dengan nyaman dan tenang.
            </div> --}}
            <div class="row">
              <div class="col-lg-6">
                <div class="d-flex align-items-center mb-4">
                  <img src="img/verif.png" height="50"  alt="">
                  <div class="ms-3">
                    <div class="text-normal nunito text-hitam fw-bold"> Terpercaya </div>
                    <div class="text-kecil nunito text-hitam"> Resmi terdaftar di Kementrian Agama Republik Indonesia dengan <a href="https://umrahcerdas.kemenag.go.id/home/detail/1029" class="text-decoration-none" rel="noopener" target="blank">Izin PPIU Kemenag RI U.7 2022</a> </div>
                  </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                  <img src="img/quran.png" height="50"  alt="">
                  <div class="ms-3">
                    <div class="text-normal nunito text-hitam fw-bold"> Sesuai Syariat Islam </div>
                    <div class="text-kecil nunito text-hitam"> Tiap tiap rangkaian kegiatan insya Allah sesuai dengan tuntunan Al-Qur'an dan As-Sunnah </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="d-flex align-items-center mb-4">
                  <img src="img/man.png" height="70"  alt="">
                  <div class="ms-3">
                    <div class="text-normal nunito text-hitam fw-bold"> Pembimbing Profesional & Berpengalaman </div>
                    <div class="text-kecil nunito text-hitam"> InsyaAllah akan dibimbing dengan Pembimbing yang amanah dan berpengalaman</div>
                  </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                  <img src="img/hotel.png" height="50"  alt="">
                  <div class="ms-3">
                    <div class="text-normal nunito text-hitam fw-bold"> Fasilitas Terbaik </div>
                    <div class="text-kecil nunito text-hitam"> Kami menyediakan fasilitas terbaik dengan harga terjangkau </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end services -->
  <!-- Affiliation -->
  {{-- <section id="affiliations" class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <div class="text-sedang barlow text-hitam fw-bold"> All Affiliations Flights and Hotels </div>
      </div>
      <div class="row row-cols-2 row-cols-lg-5 text-center">
        <div class="col">
          <img src="img/lion air.png" height="100" alt="">
        </div>
        <div class="col">
          <img src="img/batik air.png" height="100" alt="">
        </div>
        <div class="col">
          <img src="img/garuda indonesia.png" height="100" alt="">
        </div>
        <div class="col">
          <img src="img/qatar.png" height="100" alt="">
        </div>
      </div>
    </div>
  </section> --}}

  <section id="affiliations" class="py-5">
    <div class="container">
      <h3>Artikel</h3>
      <div class="row row-cols-1 row-cols-lg-4 text-left m-auto">
        @foreach ($artikel as $artikel)
        <div class="col">
          <div class="card" style="width: 18rem;">
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
  </section>

  <!-- End Affiliation -->
  <!-- watch -->
  <!-- end watch -->
@endsection