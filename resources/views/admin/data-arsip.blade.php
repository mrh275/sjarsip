@extends('templates.template')

@section('content')
    <div id="app">
        @include('templates.sidebar')
        <div id="main" class="layout-navbar navbar-fixed">
            @include('templates.navbar')

            <div id="main-content">
                <div class="page-heading">
                    <h3>Data Arsip</h3>
                </div>
                <div class="page-content">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Data Arsip Surat
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-10 d-flex align-items-center justify-content-end">
                                            <label for="custom-filter">Filter :</label>
                                        </div>
                                        <div class="col-2">
                                            <div class="custom-filter form-group">
                                                <select name="custom-filter" id="custom-filter" class="form-select">
                                                    <option value="">Pilih :</option>
                                                    <option value="01-">Januari</option>
                                                    <option value="02-">Februari</option>
                                                    <option value="03-">Maret</option>
                                                    <option value="04-">April</option>
                                                    <option value="05-">Mei</option>
                                                    <option value="06-">Juni</option>
                                                    <option value="07-">Juli</option>
                                                    <option value="08-">Agustus</option>
                                                    <option value="09-">September</option>
                                                    <option value="10-">Oktober</option>
                                                    <option value="11-">November</option>
                                                    <option value="12-">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" id="data-arsip">
                                        <thead>
                                            <tr>
                                                <th>Kode Surat</th>
                                                <th>Nomor Surat</th>
                                                <th>Customer</th>
                                                <th>Bulan Surat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ARSIP-001</td>
                                                <td>123/ABC/2023</td>
                                                <td>PT. Contoh</td>
                                                <td>2023-01-15</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-002</td>
                                                <td>456/DEF/2023</td>
                                                <td>CV. Sample</td>
                                                <td>2023-02-20</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-003</td>
                                                <td>789/GHI/2023</td>
                                                <td>UD. Example</td>
                                                <td>2023-03-10</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-004</td>
                                                <td>321/JKL/2023</td>
                                                <td>PT. Demo</td>
                                                <td>2023-04-05</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-005</td>
                                                <td>654/MNO/2023</td>
                                                <td>CV. Test</td>
                                                <td>2023-05-25</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-006</td>
                                                <td>987/PQR/2023</td>
                                                <td>UD. Sample</td>
                                                <td>2023-06-30</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-007</td>
                                                <td>159/STU/2023</td>
                                                <td>PT. Example</td>
                                                <td>2023-07-18</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-008</td>
                                                <td>753/VWX/2023</td>
                                                <td>CV. Demo</td>
                                                <td>2023-08-22</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-009</td>
                                                <td>852/YZ/2023</td>
                                                <td>UD. Test</td>
                                                <td>2023-09-12</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-010</td>
                                                <td>963/ABC/2023</td>
                                                <td>PT. Contoh</td>
                                                <td>2023-10-05</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-011</td>
                                                <td>147/DEF/2023</td>
                                                <td>CV. Sample</td>
                                                <td>2023-11-15</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-012</td>
                                                <td>258/GHI/2023</td>
                                                <td>UD. Example</td>
                                                <td>2023-12-20</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-013</td>
                                                <td>369/JKL/2023</td>
                                                <td>PT. Demo</td>
                                                <td>2023-01-10</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-014</td>
                                                <td>741/MNO/2023</td>
                                                <td>CV. Test</td>
                                                <td>2023-02-28</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-015</td>
                                                <td>852/PQR/2023</td>
                                                <td>UD. Sample</td>
                                                <td>2023-03-15</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-016</td>
                                                <td>963/STU/2023</td>
                                                <td>PT. Example</td>
                                                <td>2023-04-25</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-017</td>
                                                <td>147/VWX/2023</td>
                                                <td>CV. Demo</td>
                                                <td>2023-05-10</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-018</td>
                                                <td>258/YZ/2023</td>
                                                <td>UD. Test</td>
                                                <td>2023-06-20</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-019</td>
                                                <td>369/ABC/2023</td>
                                                <td>PT. Contoh</td>
                                                <td>2023-07-30</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-020</td>
                                                <td>741/DEF/2023</td>
                                                <td>CV. Sample</td>
                                                <td>2023-08-05</td>
                                            </tr>
                                            <tr>
                                                <td>ARSIP-021</td>
                                                <td>852/GHI/2023</td>
                                                <td>UD. Example</td>
                                                <td>2023-09-15</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
@endpush
