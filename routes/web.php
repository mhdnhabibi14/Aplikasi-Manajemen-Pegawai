<?php

use App\Http\Controllers\BagianController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Pegawai;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback(function () {
    return view('404');
});

Route::resource('pegawai', PegawaiController::class);
Route::resource('bagian', BagianController::class);

// unutuk hapus semua data secara instan
// Route::get('/truncate', function () {
//     Pegawai::truncate();
// });


// Route::get('/pegawai', function () {
//     return view('pegawai');
// });

// Route::get('/pegawai/detail/{nama}', function (string $nama) {
//     return "Nama Pegawai ini Adalah : $nama"
// });

// Route::get('/pegawai/detail/{nama?}', function (?string $nama = 'Muhammad Nurhabibi'){
//     return "Nama Pegawai ini Adalah : $nama";
// });

// Route::get('/pegawai/cek_absensi/maret', function (){
//     return "Absensi Pegawai Bulan Maret";
// })->name('cek_absensi');

// Route::get('/coba_query', function(){
//     // $pegawai = Pegawai::all();
//     // dd($pegawai->toArray());

//     // $pegawai = Pegawai::find(20);
//     // $pegawai = Pegawai::where('nama_pegawai', "Mila Melani S.E.I")->first();
//     // $pegawai = Pegawai::where('umur','>',25)->get();
//     // pegawai =Pegawai::where('nama_pegawai', 'Kacung Marpaung')->delete();
//     // Pegawai::destroy(20);
//     // Pegawai::where('id', 16)->update([
//     //     'nama_pegawai' => 'Mila Melani S.E.I'
//     // ]);

//     // dd($pegawai->toArray());
// });


// Route::get('/test', function () {
//     return redirect()->route('cek_absensi');
//     return redirect()->to('/pegawai/cek_absensi/maret');
//     return redirect()->away('https://github.com/mhdnhabibi14/Aplikasi-Manajemen-Pegawai');
// });
