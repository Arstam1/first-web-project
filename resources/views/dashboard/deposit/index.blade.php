{{-- @extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Deposit</h1>    
</div> --}}

{{-- <div class="card col-md-8"> --}}
  {{-- <div class="card-header">
    Featured
  </div> --}}
  {{-- <div class="card-body">
    <h5 class="card-title"><i class="bi bi-wallet mx-2"></i>Total Saldo</h5>
    <p class="card-text">Rp. 40.000.000</p>
    <a href="/dashboard/deposit/deposit" class="btn btn-success">Deposit</a>
    <a href="/dashboard/deposit/withdraw" class="btn btn-primary">Withdraw</a>
  </div> --}}
{{-- </div> --}}

{{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h5">Riwayat Transaksi</h1>    
</div> --}}
{{-- 
<div class="table-responsive small col-md-8">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th><i class="bi bi-arrow-left-square-fill" style="color: #ff0000;"></i></th>
        <th>Withdrawal</th>
        <th>Rp. 10.000.000</th>
        <th><i class="bi bi-check-circle-fill" style="color: #0dff00;"></i></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><i class="bi bi-arrow-right-square-fill" style="color: #0dff00;"></i></td>
        <td>Deposit</td>
        <td>Rp. 20.000.000</td>
        <td><i class="bi bi-x-circle-fill" style="color: #ff0000;"></i></td>
    </tbody>
  </table>
</div>
@endsection --}}


@extends('dashboard.layouts.main')
@section('container')
@if (auth()->user()->is_admin === 1)
@include('dashboard.admin.deposit')
@else
@include('dashboard.anggota.deposit')
@endif
@endsection
