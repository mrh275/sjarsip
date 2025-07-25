@extends('templates.template')

@section('content')
    <div id="app">
        @include('templates.sidebar')
        <div id="main" class="layout-navbar navbar-fixed">
            @include('templates.navbar')

            <div id="main-content">
                <div class="page-heading">
                    <h3>Dashboard</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="fas fa-archive"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Arsip Surat</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $total_arsip }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Customer</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $customer }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldAdd-User"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">User</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $users }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Grafik Data Arsip</h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="chart-profile-visit"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ date('Y') }} &copy;</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Ambil data 'arsips' dari PHP yang dikirim ke view
        const arsips = @json($arsips);

        // --- LOGIKA PEMROSESAN DATA PHP DI DALAM BLADE ---
        // Inisialisasi array untuk menyimpan hitungan per bulan
        let monthlyCounts = new Array(12).fill(0); // Indeks 0-11 untuk Jan-Des

        arsips.forEach(arsip => {
            // Asumsi tanggal_surat adalah string dalam format yang bisa diparse, contoh: "YYYY-MM-DD"
            // Buat objek Date dari tanggal_surat
            const date = new Date(arsip.tanggal_surat);
            const month = date.getMonth(); // getMonth() mengembalikan 0-11 (Januari-Desember)
            monthlyCounts[month]++;
        });

        const chartCategories = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const chartSeriesData = monthlyCounts;
        // --- AKHIR LOGIKA PEMROSESAN DATA PHP DI DALAM BLADE ---

        var options = {
            series: [{
                name: "Jumlah Surat", // Ganti dengan label yang relevan
                data: chartSeriesData,
            }],
            chart: {
                type: "bar",
                height: 300,
                toolbar: {
                    show: false, // Sembunyikan toolbar jika tidak dibutuhkan
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: chartCategories,
                title: {
                    text: 'Bulan'
                }
            },
            yaxis: {
                title: {
                    text: 'Jumlah Surat'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " surat"
                    }
                }
            },
            colors: ["#435ebe"], // Warna bar
        };

        var chartProfileVisit = new ApexCharts(
            document.querySelector("#chart-profile-visit"),
            options
        )
        chartProfileVisit.render()
    </script>
@endpush
