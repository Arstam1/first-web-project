{{-- @extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Deposit</h1>    
</div>

<div class="col-lg-8">
    <form>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Masukkan Nominal Deposit</label>
            <input type="email" class="form-control" id="exampleFormControlInput1">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Masukkan Nominal Deposit</label>
            <input type="email" class="form-control" id="exampleFormControlInput1">
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Upload Bukti Pembayaran</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        
        <div class="mb-3">
            <label for="formFile" class="form-label"><h5>Total Deposit</h5></label>
            <h6>Rp. 10.000.000</h6>        
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Konfirmasi Deposit</button>
        </div>
    </form>
</div>
@endsection --}}

@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Deposit</h1>    
</div>

<div class="col-lg-8">
    <form action="/dashboard/deposit/deposit" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="jumlah" class="form-label">Masukkan Nominal Deposit</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" required>
        </div>

        <div class="mb-3">            
            <input type="hidden" class="form-control" id="operasi" name="operasi" required value="tambah">
        </div>

        <div class="mb-3">            
            <input type="hidden" class="form-control" id="jenis" name="jenis" required value="Deposit">
        </div>

        <div class="mb-3">
            <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
            <input class="form-control" type="file" id="payment_proof" name="payment_proof" required>
        </div>
        
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Konfirmasi Deposit</button>
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
