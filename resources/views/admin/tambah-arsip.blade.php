@extends('templates.template')

@section('content')
    <div id="app">
        @include('templates.sidebar')
        <div id="main" class="layout-navbar navbar-fixed">
            @include('templates.navbar')

            <div id="main-content">
                <div class="page-heading">
                    <h3>Tambah Arsip</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <h6>Masukan rincian data surat yang akan ditambahkan</h6>

                                                <div class="col-12 col-lg-6 my-4">
                                                    <form action="{{ url('admin/tambah-surat') }}" method="POST" id="tambah-surat">
                                                        @csrf
                                                        <div class="mb-3 form-group">
                                                            <label for="no_surat" class="form-label">Nomor Surat</label>
                                                            <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="no_surat" class="form-label">Customer</label>
                                                            <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="no_surat" class="form-label">Tanggal Surat</label>
                                                            <input type="date" class="form-control" id="no_surat" name="no_surat" required>
                                                        </div>
                                                        <div class="mb-3 form-group d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-12 col-lg-6 my-4">
                                                    <p class="mb-2">Unggah file surat</p>
                                                    <form action="" class="dropzone" id="unggah-surat" method="POST" enctype="multipart/form-data">
                                                    </form>
                                                </div>
                                            </div>
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
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.unggahSurat = {
            url: "{{ url('admin/unggah-surat') }}",
            method: "post",
            paramName: "file",
            maxFilesize: 2, // MB
            acceptedFiles: ".pdf,.jpg,.jpeg,.png",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                this.on("success", function(file, response) {
                    console.log(response);
                    if (response.status === 'success') {
                        alert('File berhasil diunggah!');
                    } else {
                        alert('Gagal mengunggah file.');
                    }
                });
                this.on("error", function(file, response) {
                    console.error(response);
                    alert('Terjadi kesalahan saat mengunggah file.');
                });
            }
        }
    </script>
@endpush
