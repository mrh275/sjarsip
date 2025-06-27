<?php

namespace App\Exports;

use App\Models\Arsip;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet; // <-- Gunakan BeforeSheet
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell; // <-- Tambahkan ini
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class LaporanExportExcel implements FromQuery, ShouldAutoSize, WithProperties, WithTitle, WithHeadings, WithMapping, WithEvents, WithStyles, WithCustomStartCell // <-- Tambahkan WithCustomStartCell
{
    use Exportable;

    protected $periode;
    protected $tahun;
    protected $bulan;
    private $rowNumber = 0;

    public function __construct($periode, $tahun, $bulan)
    {
        $this->periode = $periode;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function query()
    {
        if ($this->periode == '1') {
            return Arsip::query()->whereYear('tanggal_surat', $this->tahun);
        } else {
            return Arsip::query()
                ->whereYear('tanggal_surat', $this->tahun)
                ->whereMonth('tanggal_surat', $this->bulan);
        }
    }

    public function headings(): array
    {
        return [
            'No.',
            'Kode Surat',
            'Nomor Surat Jalan',
            'Customer',
            'Tanggal Surat',
        ];
    }

    public function map($row): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $row->kode_surat,
            $row->no_surat_jalan,
            $row->customer,
            $row->tanggal_surat,
        ];
    }

    /**
     * Define the starting cell for the data.
     * The headings will be written in the row above this cell.
     * @return string
     */
    public function startCell(): string
    {
        // Mulai menulis data tabel (termasuk heading) dari sel A4
        return 'A4';
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Aplikasi Anda',
            'lastModifiedBy' => 'Aplikasi Anda',
            'title'          => 'Laporan Data Arsip',
            'description'    => 'Laporan Data Arsip Berdasarkan Periode',
            'subject'        => 'Laporan',
            'keywords'       => 'arsip, laporan, excel',
            'category'       => 'Laporan',
            'manager'        => 'Admin',
        ];
    }

    public function title(): string
    {
        return 'Laporan Arsip ' . $this->tahun;
    }

    public function registerEvents(): array
    {
        return [
            // Event ini dijalankan sebelum data tabel ditulis
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // --- Judul Laporan (Baris 1) ---
                $sheet->mergeCells('A1:E1');
                $sheet->setCellValue('A1', 'Laporan Data Arsip');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['size' => 16, 'bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // --- Periode Laporan (Baris 2) ---
                // Mapping nama bulan dari Inggris ke Indonesia
                $namaBulanIndonesia = [
                    'January'   => 'Januari',
                    'February'  => 'Februari',
                    'March'     => 'Maret',
                    'April'     => 'April',
                    'May'       => 'Mei',
                    'June'      => 'Juni',
                    'July'      => 'Juli',
                    'August'    => 'Agustus',
                    'September' => 'September',
                    'October'   => 'Oktober',
                    'November'  => 'November',
                    'December'  => 'Desember',
                ];

                // Dapatkan nama bulan dalam Bahasa Inggris
                $bulanNameEnglish = date('F', mktime(0, 0, 0, $this->bulan, 10));
                // Terjemahkan ke Bahasa Indonesia
                $bulanNameIndo = $namaBulanIndonesia[$bulanNameEnglish] ?? $bulanNameEnglish; // Fallback jika tidak ada di array

                $periodeText = $this->periode == '1' ? 'Tahun ' . $this->tahun : 'Bulan ' . $bulanNameIndo . ' ' . $this->tahun;

                $sheet->mergeCells('A2:E2');
                $sheet->setCellValue('A2', 'Periode ' . $periodeText);
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['size' => 14],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Styling untuk baris Heading (baris ke-4)
        return [
            4 => ['font' => ['bold' => true]],
        ];
    }
}
