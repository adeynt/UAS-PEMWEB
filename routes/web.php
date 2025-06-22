<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\BarangForm;
use App\Livewire\KategoriIndex;
use App\Livewire\LokasiIndex;
use App\Livewire\MutasiIndex;
use App\Livewire\Laporan;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    return redirect()->route('laporan');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/barang', BarangForm::class)->name('barang.form');
    Route::get('/kategori', KategoriIndex::class)->name('kategori.index');
    Route::get('/lokasi', LokasiIndex::class)->name('lokasi.index');
    Route::get('/mutasi', MutasiIndex::class)->name('mutasi.index');
    Route::get('/laporan', Laporan::class)->name('laporan');
});

require __DIR__.'/auth.php';
