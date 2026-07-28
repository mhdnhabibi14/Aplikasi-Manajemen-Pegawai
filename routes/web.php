<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/pegawai', function () {
    return view('pegawai');
});

// Route::get('/pegawai/detail/{nama}', function (string $nama) {
//     return "Nama Pegawai ini Adalah : $nama"
// });

Route::get('/pegawai/detail/{nama?}', function (?string $nama = 'Muhammad Nurhabibi'){
    return "Nama Pegawai ini Adalah : $nama";
});

Route::get('/pegawai/cek_absensi/maret', function (){
    return "Absensi Pegawai Bulan Maret";
})->name('cek_absensi');

Route::fallback(function () {
    return view('404');
});

// Route::get('/test', function () {
//     return redirect()->route('cek_absensi');
//     return redirect()->to('/pegawai/cek_absensi/maret');
//     return redirect()->away('https://github.com/mhdnhabibi14/Aplikasi-Manajemen-Pegawai');
// });