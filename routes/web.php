<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DetailServiceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    // Route Home


    // Route Kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/admin/kategori', [KategoriController::class, 'tambah'])->name('kategori.tambah');
    Route::get('/admin/kategori/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/admin/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); 

    // Route Barang
    Route::get('/admin/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/admin/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/admin/barang/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/admin/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/admin/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Route Jasa
    Route::get('/admin/jasa', [JasaController::class, 'index'])->name('jasa.index');
    Route::post('/admin/jasa', [JasaController::class, 'store'])->name('jasa.store');
    Route::get('/admin/jasa/{id}/edit', [JasaController::class, 'edit']);
    Route::put('/admin/jasa/{id}', [JasaController::class, 'update'])->name('jasa.update');
    Route::delete('/admin/jasa/{id}', [JasaController::class, 'destroy'])->name('jasa.destroy');
    
    // Route Pelanggan
    
    Route::get('/admin/pelanggan/create', [PelangganController::class, 'create'])->name('admin.pelanggan.create');
   
    Route::delete('/admin/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
    Route::post('/admin/sendReminders', [ReminderController::class, 'sendReminders'])->name('admin.sendReminders');


    // Route Laporan
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/admin/laporan/pelanggan', [LaporanController::class, 'pelanggan'])->name('laporan.pelanggan');
    Route::post('/admin/laporan/service', [LaporanController::class, 'service'])->name('laporan.service');
    Route::post('/admin/laporan/kendaraan', [LaporanController::class, 'kendaraan'])->name('laporan.kendaraan');
    Route::post('/admin/laporan/barang', [LaporanController::class, 'barang'])->name('laporan.barang');
});

Route::middleware(['auth'])->group(function () {
    // Route Home
    Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
    // Route Kendaraan
    Route::get('/admin/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
    Route::post('/admin/kendaraan', [KendaraanController::class, 'store'])->name('kendaraan.store');
    Route::get('/admin/kendaraan/{id}/edit', [KendaraanController::class, 'edit']);
    Route::put('/admin/kendaraan/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
    Route::delete('/admin/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy'); 

    // Route Reminder
    Route::get('/admin/reminder', [ReminderController::class, 'index'])->name('reminder.index');
    Route::post('/atur_pengingat', [ReminderController::class, 'store'])->name('atur_pengingat');
    
    // Route Service
    Route::get('/admin/service', [ServiceController::class, 'index'])->name('service.index');
    Route::post('/admin/service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/admin/service/{id}/edit', [ServiceController::class, 'edit']);
    Route::put('/admin/service/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/admin/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy'); 

    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan.index');
    Route::get('/admin/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/admin/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update'); 
    Route::post('/admin/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');

    // Route Detail Service
    Route::get('/admin/detail_service/{id}', [DetailServiceController::class, 'index'])->name('detail_service.index');
    Route::get('/admin/get_item/{id}', [DetailServiceController::class, 'item'])->name('detail_service.item');
    Route::get('/admin/get_barang', [DetailServiceController::class, 'barang'])->name('detail_service.barang');
    Route::get('/admin/selesai_service/{id}', [DetailServiceController::class, 'selesai'])->name('selesai.service');
    Route::post('/admin/detail_service', [DetailServiceController::class, 'store'])->name('detail_service.store');
    Route::delete('/admin/detail_service/{id}', [DetailServiceController::class, 'destroy'])->name('detail_service.destroy');
});

// Route Invoice (Terpisah agar tidak ada duplikasi)
Route::middleware(['auth'])->get('/admin/invoice/{id}', [InvoiceController::class, 'index'])->name('invoice');
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('pelanggan', PelangganController::class);
});
