<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
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

    public function storeArsip(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        // Validate and store the arsip data
        $credentials = $request->validate([
            'no_surat_jalan' => 'required',
            'customer' => 'required',
            'tanggal_surat' => 'required|date',
        ]);

        $credentials['kode_surat'] = '#' . random_int(10000, 99999); // Example of generating a unique code
        // dd($credentials);
        // Assuming you have an Arsip model
        if (Arsip::create($credentials)) {
            return redirect()->to('/admin/data-arsip')->with('success', 'Arsip added successfully.');
        };

        return redirect()->to('/admin/tambah-arsip')
            ->with('error', 'Failed to add arsip. Please try again.')
            ->withInput();
    }

    public function dataArsip()
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        $data = [
            'title' => 'Data Arsip',
            'sidebar' => 'data-arsip',
            'arsips' => Arsip::all(), // Fetch arsips with pagination
        ];

        return view('admin.data-arsip', $data);
    }

    public function hapusArsip(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }
        $kode_surat = $request->input('kode_surat');

        if (Arsip::where('kode_surat', $kode_surat)->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Arsip deleted successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete arsip. Please try again.',
            ]);
        }

        return redirect()->to('/admin/data-arsip')
            ->with('error', 'Failed to delete arsip. Please try again.');
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
