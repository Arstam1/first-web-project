@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pembayaran</h1>    
</div>

<div class="col-lg-8">
    <form action="/pembayaran" method="post">
        @csrf
        <div class="mb-3">
            <label for="jumlah" class="form-label">Masukkan Nominal Pembayaran</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" id="transaksi" name="transaksi" required value="{{ $transaksi->id }}">
        </div>
        <div class="mb-3">            
            <input type="hidden" class="form-control" id="paket" name="paket" required value="{{ $transaksi->paket_id }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Konfirmasi Pembayaran</button>
        </div>
    </form>
</div>
<script>
    var jumlah = document.getElementById('jumlah');
    jumlah.addEventListener('keyup', function(e)
    {
        jumlah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);   
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endsection