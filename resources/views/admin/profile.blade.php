@extends('templates.template')

@section('content')
    <div id="app">
        @include('templates.sidebar')
        <div id="main" class="layout-navbar navbar-fixed">
            @include('templates.navbar')

            <div id="main-content">
                <div class="page-heading">
                    <h3>Profile</h3>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ url('admin/update-profile') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ session('name') }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" disabled id="username" name="username" value="{{ session('username') }}" required>
                                            <input type="hidden" class="form-control" id="username" name="username" value="{{ session('username') }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="new_password" class="form-label">Password Baru</label>
                                            <input type="new_password" class="form-control" id="new_password" name="new_password">
                                            <small class="text-muted">Leave blank if you do not want to change your password</small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="confirm_new_password" class="form-label">Konfirmasi Password Baru</label>
                                            <input type="confirm_new_password" class="form-control" id="confirm_new_password" name="confirm_new_password">
                                            <small class="text-muted">Leave blank if you do not want to change your password</small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="foto_profil" class="mb-3">Foto Profil</label>
                                            <input type="file" id="foto_profil" name="foto_profil" class="image-preview-filepond">
                                            <small class="text-muted">Max file size 1MB, allowed formats: jpg, jpeg, png</small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
@endpush
