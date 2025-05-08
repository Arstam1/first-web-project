@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Booking</h1>
</div>

<div class="col-lg-8">
    <form action="/dashboard/pakets/{{ $paket->slug }}/booking" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tipe Kamar</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="harga" id="quad" value="{{ $paket->harga }}">
                <label class="form-check-label" for="quad">Quad : Rp. {{ number_format($paket->harga, 0, ',', '.') }}</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="harga" id="triple" value="{{ $paket->triple }}">
                <label class="form-check-label" for="triple">Triple : Rp. {{ number_format($paket->triple, 0, ',', '.') }}</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="harga" id="duo" value="{{ $paket->duo }}">
                <label class="form-check-label" for="duo">Duo : Rp. {{ number_format($paket->duo, 0, ',', '.') }}</label>
            </div>
        </div>
        <input type="hidden" name="biaya_tambahan" id="biaya_tambahan" value="0">
        <input type="hidden" name="harga_id" id="harga_id">
        <div class="mb-3">
            <label for="jumlah" class="form-label">Masukkan Nominal Uang Muka/Pelunasan</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <input id="pengajuan_passport" type="checkbox" name="pengajuan_passport">
            <label for="pengajuan_passport">(opsional) Ajukan Pembuatan Passport</label>
            <p>Bila dicentang, kami akan menghubungi anda mengenai tahapan yang diperlukan untuk mengurus passport anda setelah anda melengkapi berkas anda. nominal untuk transaksi ini sebesar Rp. 500.000</p>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" id="paket" name="paket" required value="{{ $paket->id }}">
        </div>
        {{-- <div class="mb-3">            
            <input type="hidden" class="form-control" id="harga" name="harga" required value="{{ $paket->harga }}">
        </div> --}}
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" onclick="return confirm('Dengan ini, anda setuju untuk melakukan pemesanan paket')">Konfirmasi Transaksi</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan semua elemen radio button dengan nama 'harga'
        const radioButtons = document.querySelectorAll('input[name="harga"]');
        
        // Menambahkan event listener pada setiap radio button
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                // Jika radio button dipilih, atur nilai input tersembunyi 'harga_id' sesuai dengan id radio button yang dipilih
                if (this.checked) {
                    document.getElementById('harga_id').value = this.id;
                }
            });
        });
        const passportCheckbox = document.getElementById('pengajuan_passport');
        passportCheckbox.addEventListener('change', function() {
            // Jika checkbox dicentang, tambahkan biaya tambahan ke total biaya
            const biayaTambahan = this.checked ? 500000 : 0;
            document.getElementById('biaya_tambahan').value = biayaTambahan;
        });
    });

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