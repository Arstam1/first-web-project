<?php

use App\Http\Controllers\AdminArtikellController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminMembersController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DashboardPaketsController;
use App\Http\Controllers\DashboardDepositController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\paketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use App\Models\gallery;
use App\Models\paket;
use App\Models\artikell;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// home
Route::get('/', function () {
    return view('home', [
        'paket' => paket::all(),
        'artikel' => artikell::all()
    ]);
});
// end home
// metode transaksi

Route::get('/metode-transaksi', function(){
    return view('metode');
});

// end metode transaksi

// artikel
Route::get('/article', [ArtikelController::class, 'index']);
Route::get('/article/{slug}', [ArtikelController::class, 'show']);
// end artikell

// gallery
Route::get('/gallery', function () {
    return view('gallery',[
        'gallery' => gallery::all()
    ]);
});

// paket
Route::get('/paket', [PaketController::class, 'index']);
Route::get('/paket/{slug}', [PaketController::class, 'show']);
// end paket

// about
Route::get('/about', function () {
    return view('about');
});
// end about

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
// end login

// register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('show.otp');
Route::post('/verify', [RegisterController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// end register

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('/dashboard/{email}', [DashboardController::class, 'profil'])->middleware('auth')->name('profil');
// Route::post('/dashboard/{email}', [DashboardController::class, 'edit_profil'])->middleware('auth')->name('edit profil');
Route::get('/dashboard/riwayat_paket', [DashboardController::class, 'riwayat'])->middleware('auth');
Route::get('/dashboard/formulir', [DashboardController::class, 'formulir'])->middleware('auth');
Route::post('/konfirmasiform', [DashboardController::class, 'isi'])->middleware('auth');; 

Route::get('/dashboard/dokumen', [DashboardController::class, 'dokumen'])->middleware('auth');
Route::post('/uploaddoc', [DashboardController::class, 'uploaddoc'])->middleware('auth');
// Route::post('/konfirmasi-pembayaran', [DashboardPaketsController::class, 'konfirmasi'])->middleware('auth');;
Route::get('/dashboard/pembayaran/{id}', [DashboardController::class, 'pembayaran'])->middleware('auth');;
Route::post('/pembayaran', [DashboardController::class, 'konfir_bayar'])->middleware('auth');;
Route::post('/dashboard/cancel/{id}', [DashboardController::class, 'cancel'])->middleware('auth');; 
// end dashboard

// route pengajuan passport
Route::get('/dashboard/passport_req/{id}', [DashboardController::class, 'passport_req'])->middleware('auth');
Route::post('/uploadreq', [DashboardController::class, 'uploadreq'])->middleware('auth');
// end rute pengajuan

// dashboard/pakets
Route::get('/dashboard/pakets/checkSlug', [DashboardPaketsController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/pakets', DashboardPaketsController::class)->middleware('auth');
Route::get('/dashboard/pakets/{slug}/booking', [DashboardPaketsController::class, 'booking'])->middleware('auth');
Route::post('/dashboard/pakets/{slug}/booking', [DashboardPaketsController::class, 'konfirmasi'])->middleware('auth')->name('bayar');
Route::get('/dashboard/pakets/{slug}/pendaftar', [DashboardPaketsController::class, 'manifest'])->middleware('auth');
Route::post('/dashboard/pakets/{slug}/berangkat', [DashboardPaketsController::class, 'berangkat'])->middleware('auth');
Route::post('/dashboard/pakets/{slug}/pulang', [DashboardPaketsController::class, 'pulang'])->middleware('auth');
Route::get('/dashboard/pakets/{slug}/pendaftar/kelengkapan', [DashboardPaketsController::class, 'lengkap'])->middleware('auth');
Route::get('/dashboard/pakets/{slug}/pendaftar/kelengkapan/{id}', [AdminMembersController::class, 'pelengkap'])->middleware('auth');
Route::post('/lengkapi', [AdminMembersController::class, 'lengkapi'])->middleware('auth');
// end dashboard/pakets

// dashboard/artikel
Route::get('/dashboard/artikel/checkSlug', [AdminArtikellController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/artikel', AdminArtikellController::class)->middleware('auth');
// end dashboard/artikel

// dashboard/gallery
Route::resource('/dashboard/gallery', AdminGalleryController::class)->middleware('auth');
// end dashboard/gallery

// dashboard member manager
Route::get('/dashboard/member', [AdminMembersController::class, 'index'])->middleware('auth');
Route::get('/dashboard/member/{email}', [AdminMembersController::class, 'show'])->middleware('auth');
Route::get('/dashboard/member/{email}/formulir', [AdminMembersController::class, 'formulir'])->middleware('auth');
Route::get('/dashboard/member/{email}/dokumen', [AdminMembersController::class, 'dokumen'])->middleware('auth');
Route::post('/isi', [AdminMembersController::class, 'isi'])->middleware('auth');;
Route::post('/isidoc', [AdminMembersController::class, 'isidoc'])->middleware('auth');;
// end dashboard member manager

// Deposit
Route::get('/dashboard/deposit', [DashboardDepositController::class, 'index'])->middleware('auth');

// aksi
Route::post('/dashboard/deposit/cancel/{id}', [DashboardDepositController::class, 'cancel'])->middleware('auth')->name('gagal');
Route::post('/dashboard/confirm/{id}', [DashboardDepositController::class, 'confirm'])->middleware('auth')->name('sukses');
// end aksi

Route::get('/dashboard/deposit/deposit', [DashboardDepositController::class, 'depo'])->middleware('auth');
Route::post('/dashboard/deposit/deposit', [DashboardDepositController::class, 'store'])->middleware('auth')->name('pemasukann');

Route::get('/dashboard/deposit/withdraw', [DashboardDepositController::class, 'tarik'])->middleware('auth');
Route::post('/dashboard/deposit/withdraw', [DashboardDepositController::class, 'withdraw'])->middleware('auth')->name('pengeluaran');
// end deposit