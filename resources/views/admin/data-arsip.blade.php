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
                                                    <option value="-01-">Januari</option>
                                                    <option value="-02-">Februari</option>
                                                    <option value="-03-">Maret</option>
                                                    <option value="-04-">April</option>
                                                    <option value="-05-">Mei</option>
                                                    <option value="-06-">Juni</option>
                                                    <option value="-07-">Juli</option>
                                                    <option value="-08-">Agustus</option>
                                                    <option value="-09-">September</option>
                                                    <option value="-10-">Oktober</option>
                                                    <option value="-11-">November</option>
                                                    <option value="-12-">Desember</option>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arsips as $arsip)
                                                <tr>
                                                    <td>{{ $arsip->kode_surat }}</td>
                                                    <td>{{ $arsip->no_surat_jalan }}</td>
                                                    <td>{{ $arsip->customer }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($arsip->tanggal_surat)) }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" id="edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" id="delete" value="{{ $arsip->kode_surat }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}"></script>
    <script>
        document.querySelectorAll('#delete').forEach(button => {
            button.addEventListener('click', function() {
                this.value = this.getAttribute('value');
                const kodeSurat = this.value;
                Swal.fire({
                    title: 'Hapus Arsip No. ' + kodeSurat + '?',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Logic to delete the data
                        $.ajax({
                            url: "{{ url('admin/hapus-arsip') }}",
                            type: "POST",
                            data: {
                                kode_surat: kodeSurat,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Data arsip telah dihapus.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Gagal menghapus data arsip.',
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat menghapus data arsip.',
                                    'error'
                                );
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush
