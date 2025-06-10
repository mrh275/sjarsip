<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index()
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        $data = [
            'title' => 'Dashboard',
            'sidebar' => 'dashboard',
        ];

        return view('admin.dashboard', $data);
    }

    public function tambahArsip()
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        $data = [
            'title' => 'Tambah Arsip',
            'sidebar' => 'tambah-arsip',
        ];

        return view('admin.tambah-arsip', $data);
    }

    public function dataArsip()
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        $data = [
            'title' => 'Data Arsip',
            'sidebar' => 'data-arsip',
        ];

        return view('admin.data-arsip', $data);
    }

    public function laporan()
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        $data = [
            'title' => 'Laporan',
            'sidebar' => 'laporan',
        ];

        return view('admin.laporan', $data);
    }
}
