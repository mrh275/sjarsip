<!DOCTYPE html>
<html>

<head>
    <title>Laporan Arsip Bulan {{ $bulan }} Tahun {{ $tahun }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        h3 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e9e9e9;
        }

        div.header-row {
            display: flex;
            position: relative;
            justify-content: center;
            align-items: center;
        }

        .img-brand {
            text-align: center;
            margin-bottom: 20px;
            width: fit-content;
            float: left;
        }

        .brand {
            text-align: center;
            min-width: 0;
            flex: 600px;
            /* Flex grow to take remaining space */
        }
    </style>
</head>

<body>
    <div class="header-row">
        <div class="img-brand">
            <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/assets/img/logo-adyawinsa.png'))); ?>" alt="Logo" style="width: 200px; height: auto;">
        </div>
        <div class="brand">
            <h2 style="text-align: center;">PT. Summit Adyawinsa Indonesia</h2>
            <p style="text-align: center; margin: 0; padding: 0;">Jl. Pangkal Perjuangan, Tanjungmekar, Kec. Karawang Bar., Karawang, Jawa Barat 41316</p>
            <p style="text-align: center; margin: 0; padding: 0;">Telp: (0267) 415815</p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <h3>Laporan Data Arsip</h3>
    <p>Bulan: {{ date('F', mktime(0, 0, 0, $bulan, 10)) }} Tahun: {{ $tahun }}</p>

    @if ($arsip->isEmpty())
        <p style="text-align: center; color: #888;">Tidak ada data arsip ditemukan untuk periode ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nomor Surat</th>
                    <th>Customer</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arsip as $item)
                    <tr>
                        <td>{{ $item->no_surat_jalan }}</td>
                        <td>{{ $item->customer }}</td>
                        <td>{{ $item->tanggal_surat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="export-footer" style="margin-top: 30px;padding-left: 75%; text-align: left; font-size: 12px; color: #666;">
        Dicetak pada: {{ date('d-m-Y') }}<br>
        <br>
        Oleh: Divisi Arsip<br>
        <br>
        <br>
        <br>
        <br>
        <span style="border-top: 1px solid #000; display: inline-block; width: 150px;">
            {{ session('name') }}
        </span>
    </div>
</body>

</html>
