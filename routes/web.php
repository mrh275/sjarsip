<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index']);
Route::get('/admin/dashboard', [ArsipController::class, 'index']);
Route::get('/admin/tambah-surat', [ArsipController::class, 'tambahArsip']);
