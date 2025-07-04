<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3 d-flex align-items-center">
                                <h6 class="mb-0 text-gray-600">{{ session('name') }}</h6>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ session('foto_profil') ? asset('assets/img/' . session('foto_profil')) : asset('assets/compiled/jpg/1.jpg') }}" alt="Profile Image" class="rounded-circle">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ session('name') }}!</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('admin/profile') }}"><i class="icon-mid fas fa-user me-2"></i> My
                                Profile</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('admin/users') }}"><i class="icon-mid fa fa-users me-2"></i>
                                Pengguna</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('logout') }}"><i class="icon-mid fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
