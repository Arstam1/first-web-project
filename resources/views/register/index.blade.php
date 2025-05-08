@extends('layouts.main')



@section('halamang')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif


<main class="form-regis w-100 m-auto mb-5">
    <form action="/register" method="post">
      @csrf
      <img class="mb-4" src="img/logo-awm.png" alt="" style="max-width:250px">
      <h1 class="h3 mb-3 fw-normal">Daftar Sekarang</h1>
      
      <div class="form-floating">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{  old('name')  }}">
        <label for="name">Nama</label>
        @error('name')      
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
    </div>
    

      <div class="form-floating">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
        <label for="email">Email address</label>

        @error('email')      
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror

      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required value="{{  old('password')  }}">
        <label for="password">Password</label>

        @error('password')      
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror

      </div>
  
      <button class="btn btn-primary w-100 py-2" type="submit">Daftar</button>
      </form>

      <small> Sudah punya akun? <a href="/login">Login di sini</a></small>
      
  </main>
@endsection