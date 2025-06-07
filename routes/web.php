<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index']);
Route::get('/admin/dashboard', [ArsipController::class, 'index']);
Route::get('/admin/tambah-surat', [ArsipController::class, 'tambahArsip']);
Route::get('/admin/data-arsip', [ArsipController::class, 'dataArsip']);
Route::get('/admin/laporan', [ArsipController::class, 'laporan']);
