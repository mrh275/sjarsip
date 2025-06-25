<!DOCTYPE html>
<html>

<head>
    <title>Laporan Arsip Bulan {{ $bulan }} Tahun {{ $tahun }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        h1 {
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
    </style>
</head>

<body>
    <h1>Laporan Data Arsip</h1>
    <p>Bulan: {{ date('F', mktime(0, 0, 0, $bulan, 10)) }} Tahun: {{ $tahun }}</p>

    @if ($arsip->isEmpty())
        <p style="text-align: center; color: #888;">Tidak ada data arsip ditemukan untuk periode ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Kode Surat</th>
                    <th>Nomor Surat</th>
                    <th>Customer</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arsip as $item)
                    <tr>
                        <td>{{ $item->kode_surat }}</td>
                        <td>{{ $item->no_surat_jalan }}</td>
                        <td>{{ $item->customer }}</td>
                        <td>{{ $item->tanggal_surat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
