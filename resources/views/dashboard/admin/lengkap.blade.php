@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Perlengkapan</h1>
</div>

<div class="table-responsive small col-md-10">
    @if ($lengkap)
    <a href="/dashboard/pakets/{{ $paket->slug }}/pendaftar"><button class="btn btn-primary">Cek Manifest</button></a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Tiket</th>
          <th scope="col">Visa</th>
          <th scope="col">Kain Batik</th>
          <th scope="col">Kain Ihram</th>
          <th scope="col">Tas Passport</th>
          <th scope="col">Tas Sandal</th>
          <th scope="col">Syal</th>
          <th scope="col">Koper</th>
          <th scope="col">Buku Manasik</th>
        </tr>
      <tbody>
        @foreach ($lengkap as $lengkap)
        @if ($lengkap->transaksi->status_berangkat !== 'batal')
        <tr>
          <td><a href="/dashboard/member/{{ $lengkap->user->email }}">{{ $lengkap->user->name }}</a></td>
          <td>{{ $lengkap->transaksi->status_tiket }}</td>
          <td>{{ $lengkap->transaksi->status_visa}}</td>
          <td>{{ $lengkap->batik }}</td>
          <td>{{ $lengkap->ihram}}</td>
          <td>{{ $lengkap->tpasport}}</td>
          <td>{{ $lengkap->tsandal}}</td>
          <td>{{ $lengkap->syal}}</td>
          <td>{{ $lengkap->koper}}</td>
          <td>{{ $lengkap->buku}}</td>
          <td><a href="/dashboard/pakets/{{ $lengkap->paket->slug }}/pendaftar/kelengkapan/{{ $lengkap->id }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a></td>
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>    
    @else
    belum ada Pendaftar
    @endif
  </div>

@endsection