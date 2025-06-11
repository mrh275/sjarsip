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
                                            <form action="{{ url('admin/tambah-surat') }}" method="POST" id="tambah-surat" enctype="multipart/form-data">
                                                <div class="row">
                                                    <h6>Masukan rincian data surat yang akan ditambahkan</h6>

                                                    @csrf
                                                    <div class="col-12 col-lg-6 my-4">
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
                                                    </div>
                                                    <div class="col-lg-6 col-12 my-4">
                                                        <div class="mb-3 form-group">
                                                            <label for="unggah_surat" class="mb-3">Unggah file surat</label>
                                                            <input type="file" id="unggah_surat" name="unggah_surat" class="image-preview-filepond">
                                                        </div>
                                                        <div class="mb-3 form-group d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
