<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang, {{ auth()->user()->name }}</h1>
  </div>
  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif
  
  {{-- @if($transaksi->status_pelunasan === 'belum lunas')
  <p class="text text-danger">Batas waktu pelunasan dan pengumpulan berkas : {{ $paket->tanggal_berangkat->diffForHumans(null, false, true) }}</p>
  @endif --}}
  {{-- && is_null($member --}}
  
  
<div class="container">
    <div class="row row-cols-2 row-cols-lg-2 ptext-left m-auto">
    <div class="col">
        <div class="card">
            <div class="card-header">
            Profil
            </div>
            <div class="card-body">
            <p>Nama : <strong>{{ $user->name }}</strong></p>
            <p>email : <strong>{{ $user->email }}</strong></p>
            <p>Password : </strong>****** </strong></p>            
            <a href="/dashboard/{{ auth()->user()->email }}" class="btn btn-warning"> <i class="bi bi-pencil-fill"></i> Edit</a>
            </div>
        </div>
    
    </div>
    </div>
</div>