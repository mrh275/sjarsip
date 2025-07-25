<?php

namespace App\Exports;

use App\Models\Arsip;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

// DIUBAH: WithStyles tidak lagi diperlukan karena semua styling di AfterSheet
class LaporanExportExcel implements FromQuery, ShouldAutoSize, WithProperties, WithTitle, WithHeadings, WithMapping, WithEvents, WithCustomStartCell, WithDrawings
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

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo Perusahaan');
        $drawing->setDescription('Ini adalah logo perusahaan');
        $drawing->setPath(public_path('assets/img/logo-adyawinsa.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nomor Surat Jalan',
            'Customer',
            'Tanggal Surat',
        ];
    }

    public function map($row): array
    {
        $this->rowNumber++;
        $formattedDate = Carbon::parse($row->tanggal_surat)->locale('id')->isoFormat('D MMMM YYYY');

        return [
            $this->rowNumber,
            $row->no_surat_jalan,
            $row->customer,
            $formattedDate,
        ];
    }

    /**
     * DIUBAH: Mengatur startCell ke A10. Ini akan menempatkan header di baris 10.
     * @return string
     */
    public function startCell(): string
    {
        return 'A10';
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
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $range = 'D';

                // --- Informasi Perusahaan ---
                $sheet->mergeCells('C1:' . $range . '1');
                $sheet->setCellValue('C1', 'PT. Summit Adyawinsa Indonesia');
                $sheet->getStyle('C1')->applyFromArray(['font' => ['size' => 16, 'bold' => true], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]]);
                $sheet->mergeCells('C2:' . $range . '2');
                $sheet->setCellValue('C2', 'Jl. Pangkal Perjuangan, Tanjungmekar, Kec. Karawang Bar., Karawang, Jawa Barat 41316');
                $sheet->getStyle('C2')->applyFromArray(['font' => ['size' => 12], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]]);
                $sheet->mergeCells('C3:' . $range . '3');
                $sheet->setCellValue('C3', 'Telp: (0267) 415815');
                $sheet->getStyle('C3')->applyFromArray(['font' => ['size' => 12], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]]);
                $sheet->getRowDimension('1')->setRowHeight(30);
                $sheet->getRowDimension('2')->setRowHeight(20);
                $sheet->getRowDimension('3')->setRowHeight(20);
                $sheet->getStyle('A4:' . $range . '4')->applyFromArray(['borders' => ['bottom' => ['borderStyle' => Border::BORDER_THICK, 'color' => ['argb' => 'FF000000']]]]);

                // --- Judul Laporan ---
                $sheet->mergeCells('A7:' . $range . '7');
                $sheet->setCellValue('A7', 'Laporan Data Arsip');
                $sheet->getStyle('A7')->applyFromArray(['font' => ['size' => 14, 'bold' => true], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]]);

                // --- Periode Laporan ---
                $namaBulanIndonesia = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];
                $bulanNameEnglish = date('F', mktime(0, 0, 0, $this->bulan, 10));
                $bulanNameIndo = $namaBulanIndonesia[$bulanNameEnglish] ?? $bulanNameEnglish;
                $periodeText = $this->periode == '1' ? 'Tahun ' . $this->tahun : 'Bulan ' . $bulanNameIndo . ' ' . $this->tahun;
                $sheet->mergeCells('A8:' . $range . '8');
                $sheet->setCellValue('A8', 'Periode: ' . $periodeText);
                $sheet->getStyle('A8')->applyFromArray(['font' => ['size' => 12], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]]);
            },

            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // DIUBAH: Semua styling tabel dipusatkan di sini
                $headerRow = 10; // Header tabel ada di baris 10
                $lastRow = $sheet->getHighestRow();

                // 1. Membuat header (baris 10) menjadi tebal
                $sheet->getStyle('A' . $headerRow . ':D' . $headerRow)->getFont()->setBold(true);

                // 2. Memberi border pada seluruh tabel, dari header sampai data terakhir
                $sheet->getStyle('A' . $headerRow . ':D' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // --- Area Tanda Tangan ---
                $signatureStartRow = $lastRow + 3; // Memberi jarak 2 baris kosong
                $currentDate = Carbon::now()->locale('id')->isoFormat('D MMMM YYYY');
                $adminName = session('name') ?? 'Administrator';

                // Menulis blok tanda tangan di kolom D
                $sheet->setCellValue('D' . $signatureStartRow, 'Dicetak pada : ' . $currentDate);
                $sheet->setCellValue('D' . ($signatureStartRow + 1), 'Dicetak oleh : Divisi Arsip');
                $sheet->setCellValue('D' . ($signatureStartRow + 4), '______________________');
                $sheet->setCellValue('D' . ($signatureStartRow + 5), $adminName);
                $signatureRange = 'D' . $signatureStartRow . ':D' . ($signatureStartRow + 5);
                $sheet->getStyle($signatureRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}
