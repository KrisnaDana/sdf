<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="GdY2fjlMijpYrGAM2WM9TsHULDBVcupKLvwtCeBp">
    <title>SMFT - Student Day 2023
    </title>
    <meta name="description:" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Google Fonts dan Icon -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Icon+Name">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Font-Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="lib/magnific-popup/magnific-popup.css">

    <style>
        .modal a {
            text-decoration: none;
            border-radius: 5px;
        }

        body::-webkit-scrollbar {
            width: 0.4em;
        }

        body::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #222222;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #666666;
            opacity: 0.6;
            border-radius: 10px;
        }
    </style>

</head>

<body>

    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class=""><a href="/">Home</a></li>
                    <li><a href="#">Tentang</a></li>
                    <li><a href="#">Galeri</a></li>
                    <li class="menu-has-children"><a href="#">Event</a>
                        <ul>
                            <li><a href="/">Student Day</a></li>
                            <li><a href="#">GrAnaT</a></li>
                            <li><a href="#">Bazzar Teknik</a></li>
                            <li><a href="#">TBTN</a></li>
                            <li><a href="#">TFT</a></li>
                            <li><a href="#">Portek</a></li>
                            <li><a href="#">GMT</a></li>
                            <li><a href="#">Dies Natalis</a></li>
                            <li><a href="#">BKFT</a></li>
                            <li><a href="#">MUSMA</a></li>
                            <li class="menu-has-children"><a href="#">PEMIRA</a>
                                <ul>
                                    <li><a href="#">Teknik Arsitektur</a></li>
                                    <li><a href="#">Teknik Sipil</a></li>
                                    <li><a href="#">Teknik Mesin</a></li>
                                    <li><a href="#">Teknik Elektro</a></li>
                                    <li><a href="#">Teknologi Informasi</a></li>
                                    <li><a href="#">Teknik Lingkungan</a></li>
                                    <li><a href="#">Teknik Industri</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-has-children     menu-active
"><a href="#">Penerimaan Mahasiswa</a>
                        <ul>
                            <li><a href="/">Student Day</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->
    <div class="jumbotron jumbotron-fluid"
        style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #605C3C, #3C3B3F); height: 100vh;">
        <div class="container" style="margin-top: 10vh">
            <div class="text-center">
                <img class="img-fluid mx-auto" src="img/logo-sd-2023.png" style="max-height:70vh;" alt="">
            </div>
        </div>
    </div>
    <div class="modal fade" id="daftar" tabindex="-1" aria-labelledby="daftarsd" aria-hidden="show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarsd">Akses Ketentuan Verifikasi Student Day?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pastikan anda menyetujui <strong>"SYARAT DAN KETENTUAN AKSES KETENTUAN VERIFIKASI STUDENT DAY
                        2021".</strong>
                </div>
                <div class="modal-footer">
                    <button onclick="location.href='/downloadBerkasVerif';" id="tombol" name="tombol"
                        style="margin-bottom:14px;" class="btn btn-primary mt-3 "><i class="fa fa-paper-plane"></i>
                        Lihat Ketentuan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <main id="main">
        <div class="row justify-content-center m-0">
            <div class="col-md-6">
                <div id="about">
                    <div class="container">
                        <!-- <div class="col-lg-6 content order-lg-1 order-2"> -->
                        <h2 style="color: #333; font-weight: 700; font-size: 32px;" class="title">Tentang Student Day
                        </h2>
                        <p class="text-justify wow fadeInUp">
                            Kegiatan Student Day merupakan suatu kegiatan yang menjadi rangkaian kegiatan
                            penerimaan mahasiswa baru Fakultas Teknik angkatan. Pada kegiatan ini,
                            mahasiswa baru diperkenalkan dengan kegiatan-kegiatan kemahasiswaan beserta
                            organisasi di lingkungan Senat Mahasiswa Fakultas Teknik Universitas Udayana.
                        </p>
                        <p class="text-justify wow fadeInUp" data-wow-delay="0.5s">
                            PKKMB, Student Day dan BKM merupakan rangkaian dari kegiatan penerimaan mahasiswa
                            baru di lingkungan Fakultas Teknik Universitas Udayana. Sebagaimana kegiatan penerimaan
                            mahasiswa baru lainnya, PKKMB, Student Day, dan BKM ini merupakan kegiatan yang
                            wajib diikuti yang nantinya akan mempengaruhi penginputan SKP, syarat yudisium,
                            dan kelulusan mahasiswa.
                        </p>
                        <!-- </div> -->
                    </div>
                </div>


                <div class="mb-4">
                    <section id="facts">
                        <div class="container wow fadeIn">
                            <div class="section-header">
                                </h3>
                            </div>
                            <div>
                                <img src="img/verif.jpeg" width="100%" alt="">
                            </div>
                            <div>
                                <br>
                                <p class="text-center wow fadeInUp">Peserta diharapkan untuk benar-benar memahami isi
                                    dari
                                    ketentuan secara menyeluruh sehingga pada proses Verifikasi Student Day tidak
                                    melakukan
                                    kesalahan.Ketentuan Verifikasi Student Day dapat diakses melalui tombol di bawah.
                                    <br>
                                </p>
                            </div>

                            <p class="text-center">
                                <a data-toggle="modal" data-target="#daftar" id="verify"
                                    style="border-radius:22px;color:white;" class="btn btn-info">Link Ketentuan
                                    Verifikasi</a>
                            </p>

                        </div>
                    </section>
                </div>
                <div class="mb-4">
                    <section id="facts">
                        <div class="container wow fadeIn">
                            <div class="section-header">
                                <h3 class="section-title">Pengumuman Kelulusan<br> Student Day Fakultas Teknik 2023
                                </h3>
                            </div>
                            <div>
                                <br>
                                <p class="text-center wow fadeInUp">Pengumuman kelulusan Student Day Fakultas Teknik
                                    2023
                                    dapat dilihat pada link berikut.
                                    <br>
                                </p>
                            </div>

                            <p class="text-center">
                                <a target="_blank" href="/downloadKelulusan" style="border-radius:22px;color:white;"
                                    class="btn btn-info">Download File Kelulusan</a>
                            </p>


                        </div>
                    </section>
                </div>

                <div class="mb-4">
                    <section id="facts">
                        <div class="container wow fadeIn">
                            <div class="section-header">
                                </h3>
                            </div>
                            <div>
                                <div class="container my-3">
                                    <div class="text-center">
                                        <img class="img-fluid mx-auto" src="img/logo-sd-2023.png"
                                            style="max-height:35vh;" alt="">
                                    </div>
                                </div>
                            </div>
                            <p class="text-center">
                                <a href="/login" style="border-radius:23px;margin-top:10px"
                                    class="btn btn-secondary btn-lg" aria-disabled="true">Login</a>
                            </p>
                        </div>
                    </section>
                </div>

            </div>
    </main>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Informasi Terbaru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!--==========================
Contact Section
============================-->
    <section id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-3">
                    <div class="info-pilihan">
                        <h5>Informasi Pilihan</h5>
                        <a href="/">
                            <h6>Student Day
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                            </h6>
                        </a>
                        <a href="#">
                            <h6>Pengumuman</h6>
                        </a>
                        <a target="_blank" href="#">
                            <h6>GrAnaT
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                            </h6>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="info">
                        <h5>Sekretariat SMFT</h5>
                        <div>
                            <i class="material-symbols-outlined">
                                location_on
                            </i>
                            <p>Jl. PB Sudirman<br>Denpasar, Bali</p>
                        </div>
                        <div>
                            <i class="material-symbols-outlined">
                                mail
                            </i>
                            <p>senat.ft.unud@gmail.com</p>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="https://twitter.com/smft_unud?lang=en" target="_blank" class="twitter"><i
                                class="fab fa-twitter"></i></a>
                        <a href="https://www.facebook.com/senat.ft.unud" target="_blank" class="facebook"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/smft_unud/" target="_blank" class="instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="line://ti/p/@bye5870b" target="_blank" class="instagram"><i
                                class="fab fa-line"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <iframe style="height:300px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1972.1031456915207!2d115.21920857969029!3d-8.671922290645485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd240ec7f9cc977%3A0xb424284c3310f82c!2sFakultas+Teknik+UNUD%2C+Kampus+Sudirman+-+Denpasar!5e0!3m2!1sen!2sid!4v1531969481290"
                        frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

            </div>
        </div>
    </section><!-- #contact -->

    <footer id="footer">
        <div class="container">
            <div class="py-3">
                <div class="footer-line">

                </div>
            </div>

            <div class="copyright">
                &copy; 2021 <a href="/"><strong>SMFT</strong></a>. All Rights Reserved
            </div>
        </div>
    </footer>
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/easing.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>

    <script src="js/waypoints.min.js"></script>
    <script src="js/hoverIntent.js"></script>
    <script src="js/superfish.min.js"></script>
    <script src="lib/magnific-popup/magnific-popup.min.js"></script>
    <script src="js/main.js"></script>


</body>

</html>