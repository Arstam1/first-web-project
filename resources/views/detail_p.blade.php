@extends('layouts.main')
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


    <div class="container">
    <div class="row justify-content-center m-auto">
        <div class="col-lg-8">
            <h1 class="mb-3" style="align-content: center">{{ $pakets->nama }}</h1>

            <img src="{{ asset('storage/' . $pakets->gambar) }}" width="800" height="600" alt="">
            {!! $pakets->deskripsi !!}
            <a href="/dashboard/pakets/{{ $pakets->slug }}/booking" class="btn btn-warning mb-4 mt-4"><i class="bi bi-airplane-fill"></i> Booking Sekarang</a>
        </div>
    </div>
</div>
@endsection