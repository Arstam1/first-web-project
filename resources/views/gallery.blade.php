@extends('layouts.main')
@section('halamang')
<style>
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Warna hitam dengan opacity 0.5 */
      z-index: 999; /* Z-index yang lebih tinggi dari konten utama */
      display: none; /* Mulai tersembunyi */
    } 
    
    .popup {
      display: none; /* Mulai tersembunyi */
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      z-index: 1000; /* Z-index yang lebih tinggi dari overlay */
    }
    
    .popup-content {
      /* Gaya untuk konten di dalam pop-up */
    }

    .card-img-top {
    width: 100%; /* Mengatur lebar gambar agar sesuai dengan container */
    height: 200px; /* Tetapkan tinggi gambar */
    object-fit: cover; /* Mencrop gambar agar sesuai dengan ukuran yang ditentukan */
    /* border-radius: 10px; Membuat sudut-sudut gambar menjadi bulat */
    }

</style>
<!-- hero-->
<section id="hero">
    <div class="container text-center py-5"> 
        <div class="text-super-besar barlow text-putih fw-bold mb-2">Gallery</div>
            
    </div>
    </section>
<!-- end hero-->
<!-- Offer-->
<section id="offers" class="py-5">
<div class="container">
    <div class="row row-cols-1 row-cols-lg-4 text-left">
        @foreach ($gallery as $gallery)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $gallery->gambar) }}" class="card-img-top" alt=""onclick="openPopup({{ $gallery->id }})">
                <div class="card-body">
                    <h5 class="card-title"> <span style="color:darkblue">{{ $gallery->keterangan }}</span></h5>
                    {{-- <a href="/dashboard/gallerys/{{ $gallery->id }}" class="btn btn-info"></a> --}}
                    {{-- <button class="btn btn-info" onclick="openPopup({{ $gallery->id }})"><i class="bi bi-eye-fill"></i></button> --}}
                    <div class="overlay"></div>
                    <div id="popup-{{ $gallery->id }}" class="popup">
                        <div class="popup-content">
                            <!-- Konten pop-up, seperti komentar -->
                            {{-- <p>Ini adalah komentar.</p> --}}
                            <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="" style="max-height: 500px; max-width: 500px;">
                            <br>
                            <br>
                            <button class="btn btn-secondary" onclick="closePopup({{ $gallery->id }})">Tutup</button>
                        </div>
                    </div>
                    {{-- <a href="/dashboard/gallerys/{{ $gallery->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a> --}}
                  
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>

<script>
    function openPopup(gambarId) {
        // Menampilkan overlay dan popup
        document.querySelector('.overlay').style.display = 'block';
        document.getElementById('popup-' + gambarId).style.display = 'block';
    }

    function closePopup(gambarId) {
        // Menyembunyikan overlay dan popup
        document.querySelector('.overlay').style.display = 'none';
        document.getElementById('popup-' + gambarId).style.display = 'none';
    }
</script>

@endsection