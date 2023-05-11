<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{'SMFT - Student Day '.date('Y')}}</title>
      <link rel="icon" href="{{url('/image/default/balinusaholiday.png')}}" type="image/png" />
      <link rel="stylesheet" href="{{url('/pluto/css/bootstrap.min.css')}}" />
      <link rel="stylesheet" href="{{url('/pluto/style.css')}}" />
      <link rel="stylesheet" href="{{url('/pluto/css/responsive.css')}}" />
      <link rel="stylesheet" href="{{url('/pluto/css/color_2.css')}}" />
      <link rel="stylesheet" href="{{url('/pluto/css/bootstrap-select.css')}}" />
      <link rel="stylesheet" href="{{url('/pluto/css/perfect-scrollbar.css')}}" />
      <link rel="stylesheet" href="{{url('/pluto/css/custom.css')}}" />
      <link rel="stylesheet" href="{{url('/admin/css/style.css')}}" />
      @livewireStyles
   </head>
   <body class="dashboard dashboard_2">
        <div class="full_container">
            <div class="inner_container">
                <nav id="sidebar">
                    <header class="sidebar_blog_2">
                        @if(Auth::guard('admin')->user()->role == "Admin")
                            <h4 class="text-center">ADMIN - STUDENT DAY</h4>
                        @elseif(Auth::guard('admin')->user()->role == "Kesekre")
                            <h4 class="text-center">KESEKRE - STUDENT DAY</h4>
                        @elseif(Auth::guard('user')->check())
                            <h4 class="text-center">STUDENT DAY</h4>
                        @endif
                        <ul class="list-unstyled components">
                            @if(Auth::guard('admin')->user()->role == "Admin")
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Dashboard</span></a></li>
                            <li>
                                <a href="#tour" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-briefcase orange_color"></i> <span>Akun</span></a>
                                <ul class="collapse list-unstyled" id="tour">
                                    <li><a href="{{route('admin-view-coming-soon')}}">> <span>Admin & Kesekre</span></a></li>
                                    <li><a href="{{route('admin-view-coming-soon')}}">> <span>Mahasiswa</span></a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Program Studi & QR Code</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Angkatan</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Jalur Pendaftaran</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Periode Pendaftaran</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Pengumuman</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Pendaftaran Mahasiswa</span></a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->role == "Kesekre")
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Dashboard</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Pengumuman</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Pendaftaran Mahasiswa</span></a></li>
                            @endif
                            <li>
                                <a href="#tour" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-briefcase orange_color"></i> <span>Tour</span></a>
                                <ul class="collapse list-unstyled" id="tour">
                                    <li><a href="">> <span>Tour</span></a></li>
                                    <li><a href="">> <span>Tour Category</span></a></li>
                                    <li><a href="">> <span>Tour Destination</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#fast_boat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-anchor blue2_color"></i> <span>Fast Boat</span></a>
                                <ul class="collapse list-unstyled" id="fast_boat">
                                    <li><a href="{{route('admin-view-coming-soon')}}">> <span>Fast Boat</span></a></li>
                                    <li><a href="{{route('admin-view-coming-soon')}}">> <span>Fast Boat Category</span></a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-taxi yellow_color"></i> <span>Airport Transfer</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-tags red_color"></i> <span>Discount</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-envelope blue1_color"></i> <span>Discussion</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-shopping-cart green_color"></i> <span>Transaction</span></a></li>

                            @if(Auth::guard('user')->check())
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Ganti Password</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Pengumuman</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Biodata</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Organisasi</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>Prestasi</span></a></li>
                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-bar-chart-o purple_color"></i> <span>QR Code</span></a></li>
                            @endif
                        </ul>
                    </header>
                </nav>
                <div id="content">
                    <div class="topbar">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="full">
                                <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                                <div class="logo_section">
                                    <a href="#"><img class="img-responsive" src="{{url('/img/logo-sd-2023.png')}}" alt="#" /></a>
                                </div>
                                <div class="right_topbar">
                                    <div class="icon_info">
                                        <ul>
                                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-shopping-cart"></i><span class="badge">2</span></a></li>
                                            <li><a href="{{route('admin-view-coming-soon')}}"><i class="fa fa-envelope"></i><span class="badge">3</span></a></li>
                                        </ul>
                                        <ul class="user_profile_dd">
                                            <li>
                                                @if(Auth::guard('admin')->check())
                                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{url('/img/logo-sd-2023.png')}}" alt="profile" /><span class="name_user">{{Auth::guard('admin')->user()->username}}</span></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('admin-logout')}}">Log Out</a>
                                                    </div>
                                                @endif
                                                @if(Auth::guard('user')->check())
                                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{url('/image/default/balinusaholiday.png')}}" alt="profile" /><span class="name_user">{{Auth::guard('admin')->user()->username}}</span></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('logout')}}">Log Out</a>
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
        <script src="{{url('/pluto/js/jquery.min.js')}}"></script>
        <script src="{{url('/pluto/js/popper.min.js')}}"></script>
        <script src="{{url('/pluto/js/bootstrap.min.js')}}"></script>
        <script src="{{url('/pluto/js/animate.js')}}"></script>
        <script src="{{url('/pluto/js/bootstrap-select.js')}}"></script>
        <script src="{{url('/pluto/js/owl.carousel.js')}}"></script> 
        <script src="{{url('/pluto/js/perfect-scrollbar.min.js')}}"></script>
        <script>
            var ps = new PerfectScrollbar('#sidebar');
        </script>
        <script src="{{url('/pluto/js/custom.js')}}"></script>
        @livewireScripts
    </body>
</html>