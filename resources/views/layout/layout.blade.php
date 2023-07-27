<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{'SMFT - Student Day '.date('Y')}}</title>
    <link rel="icon" href="{{url('/img/logo-sd-2023.png')}}" type="image/png" />
    <link rel="stylesheet" href="{{url('/pluto/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{url('/pluto/style.css')}}" />
    <link rel="stylesheet" href="{{url('/pluto/css/responsive.css')}}" />
    <link rel="stylesheet" href="{{url('/pluto/css/color_2.css')}}" />
    <link rel="stylesheet" href="{{url('/pluto/css/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{url('/pluto/css/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('/pluto/css/custom.css')}}" />
    <link rel="stylesheet" href="{{url('/admin/css/style.css')}}" />
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css"
        rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    s
    @livewireStyles
</head>

<body>
    @php
    $user = Auth::guard('user')->user();
    $admin = Auth::guard('admin')->user();
    @endphp
    @if($toast = Session::get('toast'))
    <div style="display: flex; justify-content: flex-end" id="toast">
        @if($toast["type"] == "success")
        <div class="p-3 align-items-center bg-success border-0" style="position: fixed; z-index: 900; width:300px;"
            role="alert" aria-live="assertive" aria-atomic="true">
            @elseif($toast["type"] == "warning")
            <div class="p-3 align-items-center bg-warning border-0" style="position: fixed; z-index: 900; width:300px;"
                role="alert" aria-live="assertive" aria-atomic="true">
                @elseif($toast["type"] == "danger")
                <div class="p-3 align-items-center bg-danger border-0"
                    style="position: fixed; z-index: 900; width:300px;" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    @else
                    <div class="p-3 align-items-center bg-primary border-0"
                        style="position: fixed; z-index: 900; width:300px;" role="alert" aria-live="assertive"
                        aria-atomic="true">
                        @endif
                        <div class="d-flex">
                            <div class="toast-body text-white">
                                {{$toast["message"]}}
                            </div>
                            <a type="button" class="me-3 m-auto text-white" aria-label="Close" id="closeToast"><i
                                    class="fa fa-close white_color"></i></a>
                        </div>
                    </div>
                </div>
                <script>
                    document.getElementById("closeToast").addEventListener("click", () => {
                    document.getElementById("toast").hidden = true;
                });
                setTimeout(function(){document.getElementById("toast").hidden = true;}, 7000);
                </script>
                @endif
                <div class="dashboard dashboard_2">
                    <div class="full_container">
                        <div class="inner_container">
                            <nav id="sidebar">
                                <header class="sidebar_blog_2">
                                    @if(!empty($admin) && $admin->role == "Admin")
                                    <h4 class="text-center">ADMIN - STUDENT DAY</h4>
                                    @elseif(!empty($admin) && $admin->role == "Kesekre")
                                    <h4 class="text-center">KESEKRE - STUDENT DAY</h4>
                                    @elseif(!empty($user))
                                    <h4 class="text-center">STUDENT DAY</h4>
                                    @endif
                                    <ul class="list-unstyled components">
                                        @if(!empty($admin) && $admin->role == "Admin")
                                        <li><a href="{{route('admin-view-dashboard')}}"><i
                                                    class="fa fa-bar-chart-o red_color"></i> <span>Dashboard</span></a>
                                        </li>
                                        <li>
                                            <a href="#tour" data-toggle="collapse" aria-expanded="false"
                                                class="dropdown-toggle"><i class="fa fa-wrench green_color"></i>
                                                <span>Kelola Akun</span></a>
                                            <ul class="collapse list-unstyled" id="tour">
                                                <li><a href="{{route('admin-view-akun-admin')}}"> <span>Admin</span></a>
                                                </li>
                                                <li><a href="{{route('admin-view-akun-mahasiswa')}}">
                                                        <span>Mahasiswa</span></a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{route('admin-view-program-studi')}}"><i
                                                    class="fa fa-university yellow_color"></i> <span>Program
                                                    Studi</span></a></li>
                                        <li><a href="{{route('admin-view-gugus')}}"><i
                                                    class="fa fa-users black_color"></i> <span>Gugus</span></a>
                                        </li>
                                        <li><a href="{{route('admin-view-jalur-pendaftaran')}}"><i
                                                    class="fa fa-fire purple_color"></i> <span>Jalur
                                                    Pendaftaran</span></a></li>
                                        <li><a href="{{route('admin-view-periode-pendaftaran')}}"><i
                                                    class="fa fa-flag red_color"></i> <span>Periode
                                                    Pendaftaran</span></a></li>
                                        <li><a href="{{route('admin-view-pengumuman')}}"><i
                                                    class="fa fa-calendar-o green_color"></i>
                                                <span>Pengumuman</span></a></li>
                                        <li><a href="{{route('admin-view-berkas')}}"><i
                                                    class="fa fa-file orange_color"></i> <span>Berkas</span></a></li>
                                        <li><a href="{{route('admin-view-registrasi')}}"><i
                                                    class="fa fa-graduation-cap blue1_color"></i>
                                                <span>Registrasi</span></a></li>
                                        @endif
                                        @if(!empty($admin) && $admin->role == "Kesekre")
                                        <li><a href="{{route('admin-view-dashboard')}}"><i
                                                    class="fa fa-bar-chart-o red_color"></i> <span>Dashboard</span></a>
                                        </li>
                                        <li><a href="{{route('admin-view-pengumuman')}}"><i
                                                    class="fa fa-calendar-o green_color"></i>
                                                <span>Pengumuman</span></a></li>
                                        <li><a href="{{route('admin-view-berkas')}}"><i
                                                    class="fa fa-file orange_color"></i> <span>Berkas</span></a></li>
                                        <li><a href="{{route('admin-view-registrasi')}}"><i
                                                    class="fa fa-graduation-cap blue1_color"></i>
                                                <span>Registrasi</span></a></li>
                                        @endif
                                        @if(!empty($user))
                                        <li><a href="{{route('view-pengumuman')}}"><i
                                                    class="fa fa-calendar-o green_color"></i>
                                                <span>Pengumuman</span></a></li>
                                        <li><a href="{{route('view-registrasi')}}"><i
                                                    class="fa fa-graduation-cap blue1_color"></i>
                                                <span>Registrasi</span></a></li>
                                        <li><a href="{{route('view-organisasi')}}"><i
                                                    class="fa fa-group orange_color"></i> <span>Organisasi</span></a>
                                        </li>
                                        <li><a href="{{route('view-prestasi')}}"><i
                                                    class="fa fa-trophy yellow_color"></i> <span>Prestasi</span></a>
                                        </li>
                                        @endif
                                        @if(!empty($user) && $user->status == "Teregistrasi")
                                        <li><a href="{{route('view-qrcode')}}"><i class="fa fa-qrcode blue2_color"></i>
                                                <span>QR Code</span></a></li>
                                        <li><a href="{{route('view-berkas')}}"><i class="fa fa-file red_color"></i>
                                                <span>Berkas</span></a></li>
                                        @endif
                                        @if(!empty($user))
                                        <li><a href="{{route('view-ganti-password')}}"><i
                                                    class="fa fa-wrench purple_color"></i> <span>Ganti
                                                    Password</span></a></li>
                                        @endif
                                    </ul>
                                </header>
                            </nav>
                            <div id="content">
                                <div class="topbar">
                                    <nav class="navbar navbar-expand-lg navbar-light">
                                        <div class="full">
                                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                                    class="fa fa-bars"></i></button>
                                            <div class="logo_section">
                                                <a href="#"><img class="img-responsive"
                                                        src="{{url('/img/logo-sd-2023.png')}}" alt="#" /></a>
                                            </div>
                                            <div class="right_topbar">
                                                <div class="icon_info">
                                                    <ul class="user_profile_dd">
                                                        <li>
                                                            @if(!empty($admin))
                                                            <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                                    class="img-responsive rounded-circle"
                                                                    src="{{url('/img/logo-sd-2023.png')}}"
                                                                    alt="profile" /><span
                                                                    class="name_user">{{$admin->username}}</span></a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{route('admin-logout')}}">Log Out</a>
                                                            </div>
                                                            @endif
                                                            @if(!empty($user))
                                                            <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                                    class="img-responsive rounded-circle"
                                                                    src="{{url('/img/logo-sd-2023.png')}}"
                                                                    alt="profile" /><span
                                                                    class="name_user">{{$user->nim}}</span></a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route('logout')}}">Log
                                                                    Out</a>
                                                            </div>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                                <main class="midde_cont">
                                    <div class="container-fluid">
                                        @yield('content')
                                    </div>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="{{url('/pluto/js/jquery.min.js')}}"></script>
                <script src="{{url('/pluto/js/popper.min.js')}}"></script>
                <script src="{{url('/pluto/js/bootstrap.min.js')}}"></script>
                <script src="{{url('/pluto/js/animate.js')}}"></script>
                <script src="{{url('/pluto/js/bootstrap-select.js')}}"></script>
                <script src="{{url('/pluto/js/owl.carousel.js')}}"></script>
                <script src="{{url('/pluto/js/perfect-scrollbar.min.js')}}"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
                    crossorigin="anonymous"></script>
                <script>
                    var ps = new PerfectScrollbar('#sidebar');
                </script>
                <script src="{{url('/pluto/js/custom.js')}}"></script>
                @livewireScripts
</body>

</html>