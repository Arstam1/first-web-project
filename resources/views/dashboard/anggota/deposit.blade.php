<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Deposit milik {{ $user->name }}</h1>    
</div>
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif
<div class="card col-md-8">
  <div class="card-body">
    <h5 class="card-title"><i class="bi bi-wallet mx-2"></i>Total Saldo</h5>
    <p class="card-text" >Rp. {{ number_format($totalBalance, 0, ',', '.') }}</p>
    <a href="/dashboard/deposit/deposit" class="btn btn-success">Deposit</a>
    <a href="/dashboard/deposit/withdraw" class="btn btn-primary">Withdraw</a>
  </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h5">Riwayat Transaksi</h1>    
</div>

@if(count($transactions) > 0)
    <div class="table-responsive small col-md-8">
      <table class="table table-striped table-sm">
        <tbody>
          @foreach($transactions as $transaksi)
          <tr>
            <td>
              @if ($transaksi->operasi === 'kurang')
              <i class="bi bi-arrow-left-square-fill" style="color: #ff0000;"></i>
              @else
              <i class="bi bi-arrow-right-square-fill" style="color: #0dff00;"></i>
              @endif
            </td>
            <td>{{ $transaksi->jenis }}</td>
            <td>Rp. {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
            <td>
              @if ($transaksi->status === 'sukses')
              <i class="bi bi-check-circle-fill" style="color: #0dff00;"></i>
              @elseif ($transaksi->status === 'gagal')
              <i class="bi bi-x-circle-fill" style="color: #ff0000;"></i>
              @else
              <i class="bi bi-clock-history" style="color: #000000;"></i>
              @endif
            </td>
            <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@else
  <p>Tidak ada riwayat transaksi.</p>
@endif

