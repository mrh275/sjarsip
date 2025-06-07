<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'sidebar' => 'dashboard',
        ];

        return view('admin.dashboard', $data);
    }

    public function tambahArsip()
    {
        $data = [
            'title' => 'Tambah Arsip',
            'sidebar' => 'tambah-arsip',
        ];

        return view('admin.tambah-arsip', $data);
    }
}
