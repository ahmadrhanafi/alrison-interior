<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() ?>/main-icon.png" type="image/x-icon">

    <style type="text/css">
        body {
            background-color: aliceblue;
            padding-top: 80px;
        }

        .footer_area {
            position: relative;
            z-index: 1;
            overflow: hidden;
            box-shadow: 0 8px 48px 8px rgba(47, 91, 234, 0.175);
            padding: 60px 30px;
        }

        .footer_area .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .footer_area .row>[class*="col-"] {
            padding-left: 15px;
            padding-right: 15px;
        }

        .single-footer-widget {
            margin-bottom: 40px;
        }

        .single-footer-widget .widget-title {
            margin-bottom: 1.5rem;
            font-weight: 800;
            color: #c80000;
        }

        .footer_menu ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .footer_menu li {
            margin-bottom: 1rem;
        }

        .footer_menu li a {
            color: #cccccc;
            font-size: medium;
            display: block;
        }

        .footer_menu li a:hover {
            color: #ffffff;
        }

        .footer_social_area a {
            display: inline-block;
            border-radius: 50%;
            height: 40px;
            width: 45px;
            text-align: center;
            background-color: #f5f5ff;
            line-height: 40px;
            margin-right: 5px;
        }

        .footer_social_area a i {
            line-height: 36px;
            font-size: 18px;
        }

        .footer-logo img {
            width: 200px;
        }

        @media screen and (max-width: 767.98px) {
            .footer_area {
                padding: 40px 20px;
            }

            .footer-logo img {
                width: 160px;
            }

            .footer_menu li {
                margin-bottom: 0.75rem;
            }

            .single-footer-widget {
                margin-bottom: 30px;
            }
        }

        @media screen and (max-width: 575.98px) {
            .footer_area {
                padding: 30px 15px;
            }

            .footer-logo img {
                width: 140px;
            }

            .footer_social_area a {
                height: 35px;
                width: 40px;
                line-height: 35px;
            }

            .footer_social_area a i {
                font-size: 16px;
                line-height: 34px;
            }

            .copyright {
                font-size: 12px;
            }
        }

        @media screen {

            a#debug-icon-link,
            #debug-icon {
                display: none;
            }
        }

        @media screen and (max-width: 780px) {
            img.main-logo {
                max-width: 200%;
            }
        }

        @media screen and (max-width: 480px) {
            img.main-logo {
                max-width: 400%;
            }
        }
    </style>

</head>

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light topbar fixed-top shadow" style="height: 80px; background-color:rgb(0, 80, 200);">

        <!-- Topbar - Brand -->

        <a class="topbar-brand" style="max-width: 10%;" href="<?= base_url('web'); ?>">
            <!-- <div class="topbar-brand-text text-white mx-2 font-weight-bold form-control-lg">Alrison Interior</div>
            <div class="topbar-divider d-none d-sm-block"></div> -->
            <img src="<?= base_url() ?>/main-logo.png" class="main-logo mb-1" style="width: 180px; position: static;" alt="Alrison Interior">
        </a>

        <!-- Sidebar Toggle (Topbar) -->
        <!-- <button id="sidebarToggleTop" class="btn btn-link d-sm-none rounded-circle mr-3">
        <i class="fas fa-lg fa-bars"></i>
        </button> -->

         <!-- Topbar Search -->
        <div class="d-flex flex-grow-1 justify-content-center px-2 mt-2 mt-sm-0">
            <form action="<?= base_url('cari-produk'); ?>" method="get" class="w-100 d-none d-sm-inline-block form-inline navbar-search" style="max-width: 500px;">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-2 small" placeholder="Cari nama atau kategori produk furniture..."
                        aria-label="Search" aria-describedby="button-search" name="keyword">
                    <button class="btn text-white" type="submit" id="button-search" style="background-color: #c80000;">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto mr-2">

            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white small"></span>
                    <i class="fas fa-bars fa-lg" style="color:rgb(230, 0, 0);"></i>
                </a>

                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= base_url('auth/login'); ?>">
                        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Login
                    </a>
                    <a class="dropdown-item" href="<?= base_url('auth/register'); ?>">
                        <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                        Register
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="<?= base_url('kontak-kami'); ?>">
                        <i class="fas fa-phone fa-sm fa-fw mr-2 text-gray-400"></i>
                        Kontak
                    </a>
                    <a class="dropdown-item" href="<?= base_url('tentang-kami'); ?>">
                        <i class="fas fa-info-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                        Tentang
                    </a>
                    <a class="dropdown-item" href="<?= base_url('dukungan'); ?>">
                        <i class="fas fa-hands-helping fa-sm fa-fw mr-2 text-gray-400"></i>
                        Dukungan
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <?= $this->renderSection('content'); ?>

    <!-- Footer -->
    <footer class="footer_area section_padding_130_0" style="margin-bottom: -20px; background-color: #212529;">
        <div class="container">
            <div class="row">
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Footer Logo-->
                        <div class="footer-logo mb-3">
                            <img src="<?= base_url() ?>/main-logo.png" style="width: 200px;" alt="">
                        </div>
                        <p style="font-size: medium; color: #cccccc;">Jln. Raya Parung Bogor Kp. Jati, RT. 02/07, Parung, Kecamatan Parung, Kabupaten Bogor, Jawa Barat 16330.</p>
                        <!-- Copywrite Text-->
                        <!-- <div class="copywrite-text mb-5">
                            <p class="mb-0" style="color: #cccccc;">Dibuat<i class="lni-heart mr-1"></i>oleh<a class="ml-1" href="#" style="font-weight: 800; color: #ffffff;">radicreative</a></p>
                        </div> -->
                        <!-- Footer Social Area-->
                        <div class="footer_social_area mt-5">
                            <a href="https://facebook.com/alrison.interior" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="fab fa-facebook-f" style="color: #c80000;"></i></a>
                            <a href="https://instagram.com/alrison.interior" data-toggle="tooltip" data-placement="top" title="" data-original-title="Instagram"><i class="fab fa-instagram" style="color: #c80000;"></i></a>
                            <a href="https://tiktok.com/alrison.interior" data-toggle="tooltip" data-placement="top" title="" data-original-title="TikTok"><i class="fab fa-tiktok" style="color: #c80000;"></i></a>
                            <a href="https://api.whatsapp.com/send/?phone=%2B6289526336995" data-toggle="tooltip" data-placement="top" title="" data-original-title="WhatsApp"><i class="fab fa-whatsapp" style="color: #c80000;"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Widget Title-->
                        <h5 class="widget-title mt-5" style="font-weight: 800; color: #c80000;">Tentang</h5>
                        <!-- Footer Menu-->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="<?= base_url('tentang/tentang-kami') ?>" style="font-size: medium; color: #cccccc;">Tentang Kami</a></li>
                                <li><a href="<?= base_url('tentang/penjualan_perusahaan') ?>" style="font-size: medium; color: #cccccc;">Penjualan Perusahaan</a></li>
                                <li><a href="<?= base_url('tentang/syarat-kebijakan') ?>" style="font-size: medium; color: #cccccc;">Syarat &amp; Kebijakan</a></li>
                                <li><a href="<?= base_url('tentang/komunitas') ?>" style="font-size: medium; color: #cccccc;">Komunitas</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Widget Title-->
                        <h5 class="widget-title mt-5" style="font-weight: 800; color: #c80000;">Dukungan</h5>
                        <!-- Footer Menu-->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="<?= base_url('dukungan/bantuan') ?>" style="font-size: medium; color: #cccccc;">Bantuan</a></li>
                                <li><a href="<?= base_url('dukungan/dukungan') ?>" style="font-size: medium; color: #cccccc;">Dukungan</a></li>
                                <li><a href="<?= base_url('dukungan/kebijakan-privasi') ?>" style="font-size: medium; color: #cccccc;">Kebijakan Privasi</a></li>
                                <li><a href="<?= base_url('dukungan/bantuan-dukungan') ?>" style="font-size: medium; color: #cccccc;">Bantuan &amp; Dukungan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg">
                    <div class="single-footer-widget section_padding_0_130">
                        <!-- Widget Title-->
                        <h5 class="widget-title mt-5" style="font-weight: 800; color: #c80000;">Kontak</h5>
                        <!-- Footer Menu-->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="<?= base_url('kontak/pusat-panggilan') ?>" style="font-size: medium; color: #cccccc;">Pusat Panggilan</a></li>
                                <li><a href="#" style="font-size: medium; color: #cccccc;">Email Kami</a></li>
                                <li><a href="<?= base_url('kontak/syarat-ketentuan') ?>" style="font-size: medium; color: #cccccc;">Syarat &amp; Ketentuan</a></li>
                                <li><a href="<?= base_url('kontak/pusat-bantuan') ?>" style="font-size: medium; color: #cccccc;">Pusat Bantuan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed-sm-bottom mt-5 d-flex justify-content-center mx-auto mt-5">
            <div class="copyright text-gray-600 text-center form-control-sm">
                <small><span>Copyright &copy; 2025 <b>Alrison Interior.</b> All Rights Reserved</span></small>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<!-- <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a> -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url() ?>/js/demo/chart-pie-demo.js"></script>

</body>

</html>