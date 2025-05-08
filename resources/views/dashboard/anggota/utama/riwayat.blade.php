@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Riwayat Pemesanan Paket</h1>
</div>
 
<div class="table-responsive small col-md-8">
  @if ($transaksis)
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Nama Paket</th>
        <th scope="col">Kategori</th>
        <th scope="col">Harga</th>
        <th scope="col">Tanggal Berangkat</th>
        <th scope="col">Status Pelunasan</th>
        <th scope="col">Status Keberangkatan</th>
      </tr>
    <tbody>
      @foreach ($transaksis as $transaksi)
      <tr>
        <td>{{ $transaksi->paket->nama }}</td>
        <td>{{ $transaksi->paket->kategori->kategori }}</td>
        <td>Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
        <td>{{ date('j F Y', strtotime($transaksi->paket->tanggal_berangkat)) }}</td>
        <td>{{ $transaksi->status_pelunasan }}</td>
        <td>{{ $transaksi->status_berangkat }}</td>
      </tr>    
      @endforeach
    </tbody>
  </table>    
  @else
  belum ada transaksi
  @endif
  
</div>
@endsection 