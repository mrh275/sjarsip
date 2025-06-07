@extends('templates.template')

@section('content')
    <div id="app">
        @include('templates.sidebar')
        <div id="main" class="layout-navbar navbar-fixed">
            @include('templates.navbar')

            <div id="main-content">
                <div class="page-heading">
                    <h3>Laporan</h3>
                </div>
                <div class="page-content">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Cetak Laporan Arsip Surat
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/cetak-laporan') }}" method="post">
                                    @csrf
                                    <div class="form-group my-3">
                                        <label for="format">Format</label>
                                        <select name="format" id="format" class="form-select">
                                            <option value="">Pilih :</option>
                                            <option value="1">PDF</option>
                                            <option value="2">Excel</option>
                                        </select>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="source">Sumber</label>
                                        <select name="source" id="source" class="form-select">
                                            <option value="">Pilih :</option>
                                            <option value="1">All</option>
                                            <option value="2">Per-Bulan</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-none my-3" id="month-wrapper">
                                        <label for="month">Bulan</label>
                                        <select name="month" id="month" class="form-select">
                                            <option value="">Pilih :</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="form-group my-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Cetak</button>
                                    </div>
                                </form>
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
        let source = document.getElementById('source');
        source.addEventListener('change', function() {
            let month = document.getElementById('month-wrapper');
            if (this.value == '2') {
                month.classList.remove('d-none');
            } else {
                month.classList.add('d-none');
            }
        });
    </script>
@endpush
