<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index']);
Route::get('/admin/dashboard', [ArsipController::class, 'index']);
Route::get('/admin/tambah-surat', [ArsipController::class, 'tambahArsip']);
Route::get('/admin/data-arsip', [ArsipController::class, 'dataArsip']);
Route::get('/admin/laporan', [ArsipController::class, 'laporan']);

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/admin/tambah-surat', [ArsipController::class, 'storeArsip']);
Route::post('/admin/hapus-arsip', [ArsipController::class, 'hapusArsip']);
Route::post('/admin/get-surat', [ArsipController::class, 'getSurat']);
Route::post('/admin/update-arsip', [ArsipController::class, 'updateArsip']);
Route::post('admin/cetak-laporan', [LaporanController::class, 'cetakLaporan']);

Route::get('admin/profile', [ProfileController::class, 'profile']);
Route::post('admin/update-profile', [ProfileController::class, 'updateProfile']);
