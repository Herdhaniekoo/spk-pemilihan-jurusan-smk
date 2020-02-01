<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="<?= base_url('assets/frontend/'); ?>img/favicon.png" type="image/png" />
    <title><?= $judul; ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/flaticon.css" />
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/themify-icons.css" />
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>vendors/nice-select/css/nice-select.css" />
    <!-- main css -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/style.css" />
</head>

<body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <div class="search_input" id="search_input_box">
                <div class="container">
                    <form class="d-flex justify-content-between" method="" action="">
                        <input type="text" class="form-control" id="search_input" placeholder="Search Here" />
                        <button type="submit" class="btn"></button>
                        <span class="ti-close" id="close_search" title="Close Search"></span>
                    </form>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="<?= base_url('assets/frontend/'); ?>img/logo.png" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('auth'); ?>">Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link search" id="search">
                                    <i class="ti-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================ End Header Menu Area =================-->

    <!--================ Start Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="banner_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner_content text-center">
                            <p class="text-uppercase">
                                Sistem Pendukung Keputusan Pemilihan Jurusan
                            </p>
                            <h2 class="text-uppercase mt-4 mb-5">
                                SMK N 1 SEYEGAN
                            </h2>
                            <div>
                                <a href="<?= base_url('auth'); ?>" class="primary-btn2 mb-3 mb-sm-0">Hitung Nilai Siswa</a>
                                <a href="<?= base_url('LaporanPdf/index'); ?>" class="primary-btn ml-sm-3 ml-0">Download Hasil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Feature Area =================-->
    <section class="feature_area section_gap_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="main_title">
                        <h2 class="mb-3">Kriteria Sistem</h2>
                        <p>
                            Kriteria Sistem Pendukung Keputusan Pemilihan Jurusan
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="icon"><span class="flaticon-student"></span></div>
                        <div class="desc">
                            <h4 class="mt-3 mb-2">4 Nilai Ujian Nasional </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="icon"><span class="flaticon-book"></span></div>
                        <div class="desc">
                            <h4 class="mt-3 mb-2">Nilai Tes Tulis</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="icon"><span class="flaticon-book"></span></div>
                        <div class="desc">
                            <h4 class="mt-3 mb-2">Nilai Tes Fisik</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="icon"><span class="flaticon-book"></span></div>
                        <div class="desc">
                            <h4 class="mt-3 mb-2">Nilai Tes Wawancara</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single_feature">
                        <div class="icon"><span class="flaticon-earth"></span></div>
                        <div class="desc">
                            <h4 class="mt-3 mb-2">Nilai Tes Psikologi</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Feature Area =================-->

    <!--================ Start Trainers Area =================-->
    <section class="trainer_area section_gap_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="main_title">
                        <h2 class="mb-3">Profil Guru</h2>
                        <p>
                            Beberapa guru pengampu di SMK N 1 Seyegan
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center d-flex align-items-center">
                <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                    <div class="thumb d-flex justify-content-sm-center">
                        <img class="img-fluid" src="<?= base_url('assets/frontend/'); ?>img/trainer/t1.jpg" alt="" />
                    </div>
                    <div class="meta-text text-sm-center">
                        <h4>Mated Nithan</h4>
                        <p class="designation">Sr. web designer</p>
                        <div class="mb-4">
                            <p>
                                If you are looking at blank cassettes on the web, you may be
                                very confused at the.
                            </p>
                        </div>
                        <div class="align-items-center justify-content-center d-flex">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"><i class="ti-twitter"></i></a>
                            <a href="#"><i class="ti-linkedin"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                    <div class="thumb d-flex justify-content-sm-center">
                        <img class="img-fluid" src="<?= base_url('assets/frontend/'); ?>img/trainer/t2.jpg" alt="" />
                    </div>
                    <div class="meta-text text-sm-center">
                        <h4>David Cameron</h4>
                        <p class="designation">Sr. web designer</p>
                        <div class="mb-4">
                            <p>
                                If you are looking at blank cassettes on the web, you may be
                                very confused at the.
                            </p>
                        </div>
                        <div class="align-items-center justify-content-center d-flex">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"><i class="ti-twitter"></i></a>
                            <a href="#"><i class="ti-linkedin"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                    <div class="thumb d-flex justify-content-sm-center">
                        <img class="img-fluid" src="<?= base_url('assets/frontend/'); ?>img/trainer/t3.jpg" alt="" />
                    </div>
                    <div class="meta-text text-sm-center">
                        <h4>Jain Redmel</h4>
                        <p class="designation">Sr. Faculty Data Science</p>
                        <div class="mb-4">
                            <p>
                                If you are looking at blank cassettes on the web, you may be
                                very confused at the.
                            </p>
                        </div>
                        <div class="align-items-center justify-content-center d-flex">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"><i class="ti-twitter"></i></a>
                            <a href="#"><i class="ti-linkedin"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                    <div class="thumb d-flex justify-content-sm-center">
                        <img class="img-fluid" src="<?= base_url('assets/frontend/'); ?>img/trainer/t4.jpg" alt="" />
                    </div>
                    <div class="meta-text text-sm-center">
                        <h4>Nathan Macken</h4>
                        <p class="designation">Sr. web designer</p>
                        <div class="mb-4">
                            <p>
                                If you are looking at blank cassettes on the web, you may be
                                very confused at the.
                            </p>
                        </div>
                        <div class="align-items-center justify-content-center d-flex">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"><i class="ti-twitter"></i></a>
                            <a href="#"><i class="ti-linkedin"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Trainers Area =================-->

    <!--================ Start Events Area =================-->
    <div class="events_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="main_title">
                        <h2 class="mb-3 text-white">Informasi</h2>
                        <p>
                            Beberapa informasi pendaftaran siswa baru
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single_event position-relative">
                        <div class="event_thumb">
                            <img src="<?= base_url('assets/frontend/'); ?>img/event/e1.jpg" alt="" />
                        </div>
                        <div class="event_details">
                            <div class="d-flex mb-4">
                                <div class="date"><span>15-18</span>Januari</div>
                                <div class="time-location">
                                    <p>
                                        <span class="ti-time mr-2"></span> 07:00 AM - 14:30
                                    </p>
                                    <p>
                                        <span class="ti-location-pin mr-2"></span> Smk N 1 Seyegan
                                    </p>
                                </div>
                            </div>
                            <p>
                                Pendaftaran calon siswa baru
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single_event position-relative">
                        <div class="event_thumb">
                            <img src="<?= base_url('assets/frontend/'); ?>img/event/e2.jpg" alt="" />
                        </div>
                        <div class="event_details">
                            <div class="d-flex mb-4">
                                <div class="date"><span>20</span>Januari</div>

                                <div class="time-location">
                                    <p>
                                        <span class="ti-time mr-2"></span> 12:00 AM - 15:00 AM
                                    </p>
                                    <p>
                                        <span class="ti-location-pin mr-2"></span> Website SPK
                                    </p>
                                </div>
                            </div>
                            <p>
                                Pengumunan hasil rekomendasi jurusan
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="text-center pt-lg-5 pt-3">
                        <a href="#" class="event-link">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Events Area =================-->
    <!--================ Start footer Area  =================-->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 single-footer-widget">
                    <h4>Top Products</h4>
                    <ul>
                        <li><a href="#">Managed Website</a></li>
                        <li><a href="#">Manage Reputation</a></li>
                        <li><a href="#">Power Tools</a></li>
                        <li><a href="#">Marketing Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 single-footer-widget">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Brand Assets</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 single-footer-widget">
                    <h4>Features</h4>
                    <ul>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Brand Assets</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 single-footer-widget">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Guides</a></li>
                        <li><a href="#">Research</a></li>
                        <li><a href="#">Experts</a></li>
                        <li><a href="#">Agencies</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 single-footer-widget">
                    <h4>Newsletter</h4>
                    <p>You can trust us. we only send promo offers,</p>
                    <div class="form-wrap" id="mc_embed_signup">
                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                            <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address'" required="" type="email" />
                            <button class="click-btn btn btn-default">
                                <span>subscribe</span>
                            </button>
                            <div style="position: absolute; left: -5000px;">
                                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text" />
                            </div>

                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> Website Sistem Pendukung Keputusan Pemilihan Jurusan </i></a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
                <div class="col-lg-4 col-sm-12 footer-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter"></i></a>
                    <a href="#"><i class="ti-dribbble"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets/frontend/'); ?>js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/popper.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/owl-carousel-thumb.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/jquery.ajaxchimp.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="<?= base_url('assets/frontend/'); ?>https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/gmaps.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/theme.js"></script>
</body>

</html>