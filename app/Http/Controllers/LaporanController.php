<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanExportExcel;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function cetakLaporan(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        // Logic to generate PDF report
        // This is a placeholder; you would implement your PDF generation logic here
        $format = $request->input('format', 'pdf'); //Default to PDF if not specified
        $periode = $request->input('periode', '1');
        $bulan = $request->input('bulan', null);
        $tahun = $request->input('tahun');
        $arsip = [];
        if ($periode == '1') {
            $arsip = Arsip::whereYear('tanggal_surat', $tahun)->get();
        } else {
            $arsip = Arsip::whereYear('tanggal_surat', $tahun)
                ->whereMonth('tanggal_surat', $bulan)->get();
        }
        // dd($arsip);
        if ($format == 'excel') {
            // 1. Export to Excel
            // Assuming you have an export class for Excel
            $filename = 'laporan-arsip-' . $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '.xlsx';

            return Excel::download(new LaporanExportExcel($periode, $tahun, $bulan), $filename);
        } else {
            $pdf = Pdf::loadView('admin.export-pdf', ['arsip' => $arsip, 'tahun' => $tahun, 'bulan' => $bulan]);

            // 4. Download PDF
            // Nama file PDF akan menjadi "arsip-2023-10.pdf" misalnya.
            $namaFile = 'arsip-' . $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '.pdf';
            return $pdf->download($namaFile);
        }
    }
}
