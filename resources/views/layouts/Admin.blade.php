<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin SOIna</title>
    <link rel="icon" href="{{ asset('admin/img/soina.jpg') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('admin/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
</head>

<body>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/kaiadmin.min.css') }}" />
    <!-- di head atau sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header d-flex align-items-center" data-background-color="dark">
                    <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('admin/img/soina.png') }}" alt="navbar brand" class="navbar-brand mt-3"
                            height="60" />
                        <span class="ms-3 text-white fw-bold d-inline-block mt-2"
                            style="font-size: 12px; line-height: 2;">Special Olympics Indonesia</span>
                    </a>

                    <div class="nav-toggle ms-auto">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>

                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('olahraga.index') ? 'active' : '' }}">
                            <a href="{{ route('olahraga.index') }}">
                                <i class="fas fa-upload"></i>
                                <p>Upload Program</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('prestasi.index') ? 'active' : '' }}">
                            <a href="{{ route('prestasi.index') }}">
                                <i class="fas fa-trophy"></i>
                                <p>Upload Prestasi</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('pengumuman.index') ? 'active' : '' }}">
                            <a href="{{ route('pengumuman.index') }}">
                                <i class="fas fa-bullhorn"></i>
                                <p>Upload Pengumuman</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('pengurus.index') ? 'active' : '' }}">
                            <a href="{{ route('pengurus.index') }}">
                                <i class="fas fa-users"></i>
                                <p>Upload Pengurus</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('pendaftar.index') ? 'active' : '' }}">
                            <a href="{{ route('pendaftar.index') }}">
                                <i class="fas fa-user-check"></i> {{-- Ikon diganti dari fa-users ke fa-user-check --}}
                                <p>Pendaftar</p>
                            </a>
                        </li>


                        <li class="nav-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}">
                                <i class="fas fa-user"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.setting.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.setting.index') }}">
                                <i class="fas fa-cogs"></i> {{-- Ikon diganti dari fa-user ke fa-cogs --}}
                                <p>Setting Pendaftaran</p>
                            </a>
                        </li>

                        <!-- Tambahkan item lainnya juga di luar dropdown -->

                        <li class="nav-item d-flex justify-content-center">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                @csrf
                                <button type="button" onclick="confirmLogout()"
                                    class="nav-link d-flex align-items-center text-danger"
                                    style="background: none; border: none; font-size: 18px;">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </li>

                        <!-- Tambahkan item lainnya juga di luar dropdown -->
                    </ul>

                    <li class="nav-item">
                        <div class="collapse" id="submenu">
                            <ul class="nav nav-collapse">
                                <li>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="collapse" id="subnav2">
                                        <ul class="nav nav-collapse subnav">
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="admin/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                @php
                    $biodata = Auth::user()->biodata;
                @endphp
                @php $loginUser = auth()->user(); @endphp
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">

                                    <div class="avatar-sm">
                                        <img src="{{ $biodata && $biodata->foto ? asset('storage/' . $biodata->foto) : asset('admin/img/logo-botak.jpg') }}"
                                            alt="Foto" class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ $biodata->nama_user ?? Auth::user()->name }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ $biodata && $biodata->foto ? asset('storage/' . $biodata->foto) : asset('admin/img/logo-botak.jpg') }}"
                                                        alt="Foto Profil" class="avatar-img rounded-circle" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ $biodata->nama_user ?? Auth::user()->name }}</h4>
                                                    <p class="text-muted">
                                                        {{ $loginUser->email ?? Auth::user()->email }}
                                                    </p>
                                                    <a href="{{ route('user.index') }}"
                                                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>

            <div class="container">
                @yield('content')
            </div>


            <script src="{{ asset('admin/js/core/jquery-3.7.1.min.js') }}"></script>
            <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
            <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>

            <!-- jQuery Scrollbar -->
            <script src="{{ asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

            <!-- Chart JS -->
            <script src="{{ asset('admin/js/plugin/chart.js/chart.min.js') }}"></script>

            <!-- jQuery Sparkline -->
            <script src="{{ asset('admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

            <!-- Chart Circle -->
            <script src="{{ asset('admin/js/plugin/chart-circle/circles.min.js') }}"></script>

            <!-- Datatables -->
            <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>

            <!-- Bootstrap Notify -->
            <script src="{{ asset('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

            <!-- jQuery Vector Maps -->
            <script src="{{ asset('admin/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
            <script src="{{ asset('admin/js/plugin/jsvectormap/world.js') }}"></script>

            <!-- Sweet Alert -->
            <script src="{{ asset('admin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

            <!-- Kaiadmin JS -->
            <script src="{{ asset('admin/js/kaiadmin.min.js') }}"></script>

            <script>
                function confirmLogout() {
                    Swal.fire({
                        title: 'Keluar Aplikasi?',
                        text: "Anda yakin ingin logout?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                }
            </script>


            <!-- Toastr CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

            <!-- Toastr JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



</body>

</html>
