@extends('templates.template')

@section('content')
    <div id="app">
        @include('templates.sidebar')
        <div id="main" class="layout-navbar navbar-fixed">
            @include('templates.navbar')

            <div id="main-content">
                <div class="page-heading">
                    <h3>Data Arsip</h3>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
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
                                                <th>Nomor Surat</th>
                                                <th>Customer</th>
                                                <th>Tanggal Surat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arsips as $arsip)
                                                <tr>
                                                    <td id="nomor_surat_jalan">{{ $arsip->no_surat_jalan }}</td>
                                                    <td>{{ $arsip->customer }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($arsip->tanggal_surat)) }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-secondary" id="show" value="{{ url('arsip/surat') . '/' . $arsip->file_surat }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" value="{{ $arsip->no_surat_jalan }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" id="delete" value="{{ $arsip->no_surat_jalan }}">
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
    <!-- Vertically Centered modal Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data Arsip
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="badge bg-primary">Nomor Surat: <span id="editNoSuratJalan"></span></span>
                    <div class="row my-3">
                        <h6>Masukan rincian data surat yang akan diubah</h6>

                        <div class="col-12 my-4">
                            <form action="{{ url('admin/update-arsip') }}" method="POST" id="edit-surat" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="no_surat_jalan" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" id="no_surat_jalan" name="no_surat_jalan" required>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="customer" class="form-label">Customer</label>
                                    <input type="text" class="form-control" id="customer" name="customer" required>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                    <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                                </div>
                                <div class="mb-3 form-group">
                                    <p class="mb-2">Unggah file surat</p>
                                    <input type="file" name="unggah_surat" class="image-preview-filepond">
                                </div>
                                <div class="mb-3 form-group d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Image Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Lampiran Arsip
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="badge bg-primary">Nomor Surat: <span id="lampiranNomorSurat"></span></span>
                    <div class="row my-3">
                        <h6>Lampiran</h6>
                        <div class="col-12" id="show-content">

                        </div>
                    </div>
                </div>
            </div>
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
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="{{ asset('assets') }}/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('assets') }}/extensions/toastify-js/src/toastify.js"></script>
    <script src="{{ asset('assets') }}/static/js/pages/filepond.js"></script>
    <script>
        // Pastikan skrip ini dijalankan setelah DOM sepenuhnya dimuat dan jQuery tersedia.
        // Menempatkannya di dalam $(document).ready() adalah praktik yang baik jika menggunakan jQuery.
        $(document).ready(function() {

            // Event listener untuk menangani klik pada tombol yg ada di halaman ini.
            document.addEventListener('click', function(event) {

                // Event untuk menampilkan modal dengan gambar lampiran surat.
                const clickedButton = event.target.closest('#show'); // Mengubah dari class menjadi ID

                if (clickedButton) {

                    // Mengambil nilai 'value' dari tombol, yang berisi URL gambar lampiran.
                    const imageUrl = clickedButton.getAttribute('value');

                    // Mengisi konten modal dengan gambar menggunakan jQuery.
                    // Pastikan elemen dengan ID 'show-content' ada di modal kamu.
                    if ($('#show-content').length) {
                        $('#show-content').html('<img src="' + imageUrl + '" class="img-fluid" alt="Lampiran Surat">');
                        // 1. Dapatkan elemen <tr> terdekat (parent dari tombol yang diklik)
                        const row = clickedButton.closest('tr');
                        // 2. Dari elemen <tr>, cari <td> dengan ID 'nomor_surat_jalan'
                        // Penting: Pastikan ID 'nomor_surat_jalan' ini unik per baris. Jika tidak, pakai class.
                        const nomorSurat = row.querySelector('#nomor_surat_jalan');
                        const labelNomorSurat = document.querySelector('span#lampiranNomorSurat');
                        labelNomorSurat.textContent = nomorSurat.textContent; // Setel teks pada
                    } else {
                        console.error("Elemen dengan ID 'show-content' tidak ditemukan.");
                    }

                    // Menampilkan modal Bootstrap menggunakan jQuery.
                    // Pastikan elemen dengan ID 'showModal' adalah modal Bootstrap kamu.
                    if ($('#showModal').length) {
                        $('#showModal').modal('show');
                    } else {}

                } else {
                    // Ini akan log jika klik terjadi, tetapi bukan pada tombol yang ditargetkan.
                    // Bisa dihapus setelah debugging.
                    console.log("Klik bukan pada tombol dengan ID 'show'.");
                }

                // Event untuk menghapus data arsip.
                const clickedDeleteButton = event.target.closest('#delete');

                if (clickedDeleteButton) {
                    console.log("Tombol dengan ID 'delete' ditemukan:", clickedDeleteButton);

                    // Mengambil nilai 'value' dari tombol, yang berisi kode surat yang akan dihapus.
                    const noSuratJalan = clickedDeleteButton.getAttribute('value');
                    console.log("Nomor Surat yang akan dihapus:", noSuratJalan);

                    // Menampilkan konfirmasi SweetAlert2 sebelum menghapus.
                    // Pastikan SweetAlert2 (Swal) sudah dimuat di halaman Anda.
                    Swal.fire({
                        title: 'Hapus Arsip No. ' + noSuratJalan + '?',
                        text: "Apakah Anda yakin ingin menghapus data ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log("Konfirmasi hapus diterima.");
                            // Logika untuk menghapus data menggunakan AJAX.
                            $.ajax({
                                url: "{{ url('admin/hapus-arsip') }}", // Pastikan URL ini sesuai dengan route Anda
                                type: "POST",
                                data: {
                                    no_surat_jalan: noSuratJalan,
                                    // Pastikan CSRF token tersedia. Anda mungkin perlu menyediakannya secara global
                                    // atau memastikan template Blade Anda merendernya dengan benar.
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    if (response.status == 'success') {
                                        console.log("Hapus berhasil:", response);
                                        Swal.fire(
                                            'Dihapus!',
                                            'Data arsip telah dihapus.',
                                            'success'
                                        ).then(() => {
                                            // Memuat ulang halaman setelah penghapusan berhasil
                                            location.reload();
                                        });
                                    } else {
                                        console.error("Hapus gagal. Respon:", response);
                                        Swal.fire(
                                            'Error!',
                                            'Gagal menghapus data arsip.',
                                            'error'
                                        );
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("Terjadi kesalahan AJAX saat menghapus:", error);
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menghapus data arsip.',
                                        'error'
                                    );
                                }
                            });
                        } else {
                            console.log("Konfirmasi hapus dibatalkan.");
                        }
                    });
                }

                const clickedEditButton = event.target.closest('#edit');

                if (clickedEditButton) {
                    console.log("Tombol dengan ID 'edit' ditemukan:", clickedEditButton);

                    // Mengambil nilai 'value' dari tombol, yang berisi kode surat untuk diedit.
                    const noSuratJalan = clickedEditButton.getAttribute('value');
                    console.log("Nomor Surat yang akan diedit:", noSuratJalan);
                    // Mengisi elemen dengan ID 'editNoSuratJalan' dengan nomor surat yang akan diedit.
                    const editNoSuratJalan = document.querySelector('span#editNoSuratJalan');
                    if (editNoSuratJalan) {
                        editNoSuratJalan.textContent = noSuratJalan;
                    }

                    // Melakukan permintaan AJAX untuk mendapatkan data arsip.
                    $.ajax({
                        url: "{{ url('admin/get-surat') }}", // Pastikan URL ini sesuai dengan route Anda
                        type: "POST",
                        data: {
                            no_surat_jalan: noSuratJalan,
                            _token: "{{ csrf_token() }}" // Pastikan CSRF token tersedia
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                console.log("Data arsip berhasil didapatkan:", response.data);
                                // Mengisi form input di modal edit dengan data yang diterima.
                                $('#no_surat_jalan').val(response.data.no_surat_jalan);
                                $('#customer').val(response.data.customer);
                                $('#tanggal_surat').val(response.data.tanggal_surat);

                                // Menampilkan modal edit (asumsi ID modal adalah #editModal)
                                // Pastikan elemen dengan ID 'editModal' adalah modal Bootstrap kamu.
                                if ($('#editModal').length) {
                                    $('#editModal').modal('show');
                                    console.log("Modal 'editModal' ditampilkan.");
                                } else {
                                    console.error("Elemen dengan ID 'editModal' tidak ditemukan.");
                                }

                            } else {
                                console.error("Gagal mendapatkan data arsip. Respon:", response);
                                Swal.fire(
                                    'Error!',
                                    'Gagal mendapatkan data arsip.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Terjadi kesalahan AJAX saat mendapatkan data arsip:", error);
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat mendapatkan data arsip.',
                                'error'
                            );
                        }
                    });
                }

                // const editSuratForm = document.getElementById('edit-surat');
                // if (editSuratForm) {
                //     editSuratForm.addEventListener('submit', function(e) {
                //         e.preventDefault(); // Prevents the default form submission.
                //         console.log("Form 'edit-surat' submitted.");

                //         const formData = new FormData(this);

                //         // Appends 'kode_surat' to the FormData.
                //         // It's assumed 'kodeSurat' element exists and contains the correct value.
                //         if (document.getElementById('kodeSurat')) {
                //             formData.append('kode_surat', document.getElementById('kodeSurat').textContent);
                //             console.log("kode_surat appended to FormData:", document.getElementById('kodeSurat').textContent);
                //         } else {
                //             console.warn("Element with ID 'kodeSurat' not found for form submission.");
                //         }

                //         Swal.fire({
                //             title: 'Updating archive data...',
                //             allowOutsideClick: false,
                //             willOpen: () => {
                //                 Swal.showLoading(); // Show loading animation
                //                 console.log("SweetAlert loading displayed.");
                //             },
                //             didOpen: () => {
                //                 // Perform AJAX request inside didOpen to ensure loading animation is visible.
                //                 $.ajax({
                //                     url: "{{ url('admin/update-arsip') }}", // Ensure this URL matches your route
                //                     type: "POST",
                //                     headers: {
                //                         'X-CSRF-TOKEN': "{{ csrf_token() }}" // Ensure CSRF token is included
                //                     },
                //                     data: formData,
                //                     contentType: false, // Required for FormData
                //                     processData: false, // Required for FormData
                //                     success: function(response) {
                //                         if (response.status == 'success') {
                //                             console.log("Update successful:", response);
                //                             Swal.fire(
                //                                 'Updated!',
                //                                 'Archive data has been updated.',
                //                                 'success'
                //                             ).then(() => {
                //                                 location.reload(); // Reload the page after successful update
                //                             });
                //                         } else {
                //                             console.error("Update failed. Response:", response);
                //                             Swal.fire(
                //                                 'Error!',
                //                                 'Failed to update archive data.',
                //                                 'error'
                //                             );
                //                         }
                //                     },
                //                     error: function(xhr, status, error) {
                //                         console.error("AJAX error occurred during update:", error);
                //                         Swal.fire(
                //                             'Error!',
                //                             'An error occurred while updating archive data.',
                //                             'error'
                //                         );
                //                     }
                //                 });
                //             },
                //             didClose: () => {
                //                 // Swal.hideLoading() is typically not needed here as Swal.fire closes itself
                //                 // or is replaced by another Swal.fire call.
                //                 console.log("SweetAlert loading hidden (if applicable).");
                //             }
                //         });
                //     });
                // } else {
                //     console.error("Form with ID 'edit-surat' not found. Submit listener not attached.");
                // }
            });
        });
    </script>
@endpush
