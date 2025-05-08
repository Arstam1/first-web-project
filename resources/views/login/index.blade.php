@extends('layouts.main')


@section('halamang')

<main class="form-signin w-100 m-auto mb-5" style="padding-top: 100px">
  @if(session()->has('loginError'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('loginError') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif
    <form action="/login" method="post">
      @csrf
      <img class="mb-4" src="img/logo-awm.png" alt="" style="max-width:250px">
      <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>
  
      <div class="form-floating">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}" id="email" placeholder="name@example.com" autofocus>
        <label for="email">Email address</label>
        @error('email')      
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('password') }}">
        <label for="Password">Password</label>
        @error('password')      
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
  
      <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
      </form>

      <small>Belum punya akun? <a href="/register">Buat sekarang</a></small>
      
  </main>
@endsection