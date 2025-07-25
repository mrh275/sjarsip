<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'total_arsip' => Arsip::count(),
            'users' => User::count(),
            'arsips' => Arsip::all()
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
            'unggah_surat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Validate file type and size
        ]);

        $fileSurat = $request->file('unggah_surat');
        $newFileName = $credentials['no_surat_jalan'] . '.' . $fileSurat->extension();
        $fileSurat->move(public_path('arsip/surat'), $newFileName);
        $credentials['file_surat'] = $newFileName;

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
            'arsips' => Arsip::all(),

        ];

        return view('admin.data-arsip', $data);
    }

    public function hapusArsip(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }
        $no_surat_jalan = $request->input('no_surat_jalan');

        if (Arsip::where('no_surat_jalan', $no_surat_jalan)->delete()) {
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

    public function getSurat(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        $no_surat_jalan = $request->input('no_surat_jalan');
        $arsip = Arsip::where('no_surat_jalan', $no_surat_jalan)->first();

        if ($arsip) {
            return response()->json([
                'status' => 'success',
                'data' => $arsip,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Arsip not found.',
            ]);
        }
    }

    public function updateArsip(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }
        $kode_surat = $request->input('kode_surat');
        $arsip = Arsip::where('kode_surat', $kode_surat)->first();

        if (!$arsip) {
            return redirect()->to('/admin/data-arsip')
                ->with('error', 'Arsip not found.');
        }

        // Validate and update the arsip data
        $credentials = $request->validate([
            'no_surat_jalan' => 'required',
            'customer' => 'required',
            'tanggal_surat' => 'required|date',
        ]);

        if ($request->file('unggah_surat')) {
            $fileSurat = $request->file('unggah_surat');
            $newFileName = $credentials['no_surat_jalan'] . '.' . $fileSurat->extension();
            $fileSurat->move(public_path('arsip/surat'), $newFileName);
        }

        if ($arsip->update($credentials)) {
            return redirect()->to('/admin/data-arsip')->with('success', 'Arsip berhasil diperbaharui.');
        } else {
            return redirect()->to('/admin/data-arsip')
                ->with('error', 'Arsip gagal di perbaharui.')
                ->withInput();
        }
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
