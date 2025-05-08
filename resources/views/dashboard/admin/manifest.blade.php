@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Pendaftar</h1>
</div>

<div class="table-responsive small col-md-10">
  <form action="/dashboard/pakets/{{ $paket->slug }}/berangkat" method="post" class="d-inline">  
    @csrf
    <button class="btn btn-success" onclick="return confirm('Tandai telah berangkat?')">Tandai telah berangkat</button>
  </form>
  <form action="/dashboard/pakets/{{ $paket->slug }}/pulang" method="post" class="d-inline">  
    @csrf
    <button class="btn btn-danger" onclick="return confirm('Tandai telah pulang?')">Tandai telah pulang</button>
  </form>
    @if ($transaksi)
    <a href="/dashboard/pakets/{{ $paket->slug }}/pendaftar/kelengkapan"><button class="btn btn-primary">Cek Kelengkapan</button></a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Gender</th>
          <th scope="col">City</th>
          <th scope="col">Date</th>
          <th scope="col">No. Passport</th>
          <th scope="col">D. Issue</th>
          <th scope="col">D. Expiry</th>
          <th scope="col">Issuing Office</th>
          <th scope="col">Pengajuan Passport</th>
          <th scope="col">Total setoran</th>
          <th scope="col">Sisa Setoran</th>
          <th scope="col">Status Pelunasan</th>
          <th scope="col">Status Berangkat</th>
        </tr>
      <tbody>
        @foreach ($transaksi as $transaksi)
        @if ($transaksi->status_berangkat != 'batal')
        <tr>
          <td><a href="/dashboard/member/{{ $transaksi->user->email }}">{{ $transaksi->user->name }}</a></td>
          <td>{{ substr($transaksi->user->member->jenis_kelamin, 0, 1) }}</td>
          <td>{{ $transaksi->user->member->kota}}</td>
          <td>{{ date('j F Y', strtotime($transaksi->user->member->tgl_lahir)) }}</td>
          <td>{{ $transaksi->user->member->no_passport}}</td>
          <td>{{ $transaksi->user->member->dissue}}</td>
          <td>{{ $transaksi->user->member->dexpiry}}</td>
          <td>{{ $transaksi->user->member->issuing_office}}</td>
          <td>{{ $transaksi->pengajuan_passport}}</td>
          <td>Rp. {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
          <td>Rp. {{ number_format($transaksi->total_harga - $transaksi->jumlah, 0, ',', '.') }}</td>
          <td>{{ $transaksi->status_pelunasan}}</td>
          <td>{{ $transaksi->status_berangkat}}</td>
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