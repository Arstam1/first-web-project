@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Perlengkapan</h1>
</div>

<div class="col-lg-8">
    <form action="/lengkapi" method="post">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $lengkap->id }}">
        <div class="mb-3">
            <label class="form-label">Visa : </label>
                <input class="form-check-input" type="radio" name="status_visa" id="status_visa1" value="terbit">
                <label class="form-check-label" for="status_visa1">Iya</label>
                <input class="form-check-input" type="radio" name="status_visa" id="status_visa2" value="belum terbit">
                <label class="form-check-label" for="status_visa2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiket : </label>
                <input class="form-check-input" type="radio" name="status_tiket" id="status_tiket1" value="terbit">
                <label class="form-check-label" for="status_tiket1">Iya</label>
                <input class="form-check-input" type="radio" name="status_tiket" id="status_tiket2" value="belum terbit">
                <label class="form-check-label" for="status_tiket2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Kain Batik : </label>
                <input class="form-check-input" type="radio" name="batik" id="batik1" value="iya">
                <label class="form-check-label" for="batik1">Iya</label>
                <input class="form-check-input" type="radio" name="batik" id="batik2" value="tidak">
                <label class="form-check-label" for="batik2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Kain Ihram : </label>
                <input class="form-check-input" type="radio" name="ihram" id="ihram1" value="iya">
                <label class="form-check-label" for="ihram1">Iya</label>
                <input class="form-check-input" type="radio" name="ihram" id="ihram2" value="tidak">
                <label class="form-check-label" for="ihram2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Tas Passport : </label>
                <input class="form-check-input" type="radio" name="tpasport" id="tpasport1" value="iya">
                <label class="form-check-label" for="tpasport1">Iya</label>
                <input class="form-check-input" type="radio" name="tpasport" id="tpasport2" value="tidak">
                <label class="form-check-label" for="tpasport2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Tas Sandal : </label>
                <input class="form-check-input" type="radio" name="tsandal" id="tsandal1" value="iya">
                <label class="form-check-label" for="tsandal1">Iya</label>
                <input class="form-check-input" type="radio" name="tsandal" id="tsandal2" value="tidak">
                <label class="form-check-label" for="tsandal2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Syal : </label>
                <input class="form-check-input" type="radio" name="syal" id="syal1" value="iya">
                <label class="form-check-label" for="syal1">Iya</label>
                <input class="form-check-input" type="radio" name="syal" id="syal2" value="tidak">
                <label class="form-check-label" for="syal2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Koper : </label>
                <input class="form-check-input" type="radio" name="koper" id="koper1" value="iya">
                <label class="form-check-label" for="koper1">Iya</label>
                <input class="form-check-input" type="radio" name="koper" id="koper2" value="tidak">
                <label class="form-check-label" for="koper2">Tidak</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Buku Manasik : </label>
                <input class="form-check-input" type="radio" name="buku" id="buku1" value="iya">
                <label class="form-check-label" for="buku1">Iya</label>
                <input class="form-check-input" type="radio" name="buku" id="buku2" value="tidak">
                <label class="form-check-label" for="buku2">Tidak</label>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" onclick="return confirm('Update Perlengkapan?')">Konfirmasi</button>
        </div>
    </form>
</div>

@endsection