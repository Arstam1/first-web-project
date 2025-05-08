<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda AWM TOUR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">     --}}
    
    
    <link rel = "stylesheet" href="{{ asset('css/style.css') }}"/>
  </head>
  <body>
    <!-- navbar-->
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"> --}}
      <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="{{ asset('img/logo-awm.png') }}" height="50px" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Beranda</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/paket">Paket</a>
              </li> --}}

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Paket
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/paket">Katalog Paket</a></li>
                  <li><a class="dropdown-item" href="/metode-transaksi">Metode Transaksi</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link active" href="/about" role="button">
                  Tentang Kami
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/gallery">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/article">Artikel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
              </li>
            </ul>
            @auth
            <div class="d-flex">
              <form action="/logout" method="post">
                @csrf  
                <button class="btn btn-dark">Logout</button>
              </form>
            </div>
            @else    
            <div class="d-flex">
              {{-- <a href="/login"><button class="btn btn-outline-warning">Login</button></a> --}}
              <a href="/login"><button class="btn btn-dark">Login</button></a>
            </div>
            @endauth
          </div>
        </div>
      </nav>
      <section id="hor-blok"></section>
      {{-- <div class="container" style="background-color: aqua; height:100px; width:100%"></div> --}}
    <!-- End navbar-->
@yield('halamang')

@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>