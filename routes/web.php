<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
};
use App\Http\Controllers\ComPro\{
    Home,
    Login,
    Berita,
    Galeri,
};


Route::get('/', [Home::class, 'index'])->name('home');
Route::get('home', [Home::class, 'index']);
Route::get('kontak', [Home::class, 'kontak']);
Route::post('kirim-kontak', [Home::class, 'kirim_kontak']);
Route::get('konfirmasi', [Home::class, 'konfirmasi']);
Route::get('berhasil/{par1}', [Home::class, 'berhasil']);
Route::get('cetak/{par1}', [Home::class, 'cetak']);
Route::get('ts3', [Home::class, 'ts3']);

// Login
Route::get('login', [Login::class, 'index'])->name('login');
Route::post('login/check', [Login::class, 'check']);
Route::post('login/login-konfirmasi-process', [Login::class, 'konfimasi_proses']);
Route::get('login/login-konfirmasi/{par1}', [Login::class, 'konfimasi']);
Route::get('login/lupa', [Login::class, 'fogot']);
Route::post('login/forgot-process', [Login::class, 'forgot_process']);
Route::get('login/verify/{par1}', [Login::class, 'verify']);
Route::post('login/verify-process', [Login::class, 'verify_process']);

// Berita
Route::get('berita', [Berita::class, 'index']);
Route::get('berita/read/{par1}', [Berita::class, 'read']);
Route::get('berita/layanan/{par1}', [Berita::class, 'layanan']);
Route::get('berita/terjadi/{par1}', [Berita::class, 'terjadi']);
Route::get('berita/kategori/{par1}', [Berita::class, 'kategori']);
Route::get('berita/sop-layanan/{par1}', [Berita::class, 'sop_layanan']);


// galeri
Route::get('galeri', [Galeri::class, 'index']);
Route::get('galeri/detail/{par1}', [Galeri::class, 'detail']);


Route::group(['middleware' => ['auth.custom']], function() {
    Route::get('lobby', [HomeController::class, 'lobby'])->name('lobby');
    Route::post('logout', [HomeController::class, 'logout'])->name('logout');
});
