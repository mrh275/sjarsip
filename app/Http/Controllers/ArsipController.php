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

    public function dataArsip()
    {
        $data = [
            'title' => 'Data Arsip',
            'sidebar' => 'data-arsip',
        ];

        return view('admin.data-arsip', $data);
    }

    public function laporan()
    {
        $data = [
            'title' => 'Laporan',
            'sidebar' => 'laporan',
        ];

        return view('admin.laporan', $data);
    }
}
