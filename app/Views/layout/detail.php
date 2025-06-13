<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= esc($title ?? 'Alrison Interior'); ?></title>
    <meta name="description" content="<?= esc($desription ?? 'Selamat Datang di Alrison Interior') ?>">
    <meta property="og:title" content="<?= esc($title ?? '') ?>">
    <meta property="og:description" content="<?= esc($desription ?? '') ?>">
    <meta property="og:image" content="<?= esc($image ?? '') ?>">
    <meta property="og:url" content="<?= esc($url ?? '') ?>">
    <meta property="og:type" content="produk" />



    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() ?>/main-icon.png" type="image/x-icon">

    <style type="text/css">
        body {
            background-color: aliceblue;
            color: #333333;
            font-family: 'Segoe UI', sans-serif;
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
    <nav class="navbar navbar-expand navbar-light topbar fixed-top shadow px-2" style="height: 80px; background-color:rgb(0, 80, 200);">

        <!-- Topbar - Brand -->
        <a class="topbar-brand" style="max-width: 10%;" href="<?= base_url('web'); ?>">
            <img src="<?= base_url() ?>/main-logo.png" class="main-logo mb-1" style="width: 150px; position: static;" alt="Alrison Interior">
        </a>

        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

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
        <ul class="navbar-nav ml-auto mr-1">

            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <?php if (!session()->has('level')) : ?>
                    <!-- Jika belum login -->
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-white small"></span>
                        <i class="fas fa-bars fa-lg" style="color:rgb(230, 0, 0);"></i>
                    </a>
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

                        <a class="dropdown-item" href="<?= base_url('kontak'); ?>">
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

                <?php else : ?>
                    <!-- Jika sudah login -->
                    <?php
                    $fotoProfile = session()->get('gambar_user') && session()->get('gambar_user') != ''
                        ? session()->get('gambar_user')
                        : 'default.jpeg';
                    ?>

                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('profile/' . $fotoProfile); ?>">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('profil-saya'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?= session()->get('nama_user'); ?>
                        </a>
                        <?php if (session()->get('level') == 2) : ?>
                            <a class="dropdown-item" href="<?= base_url('keranjang'); ?>">
                                <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i>
                                Keranjang
                                &nbsp;<span class="badge badge-danger badge-circle"><?= $totalItem; ?></span>
                            </a>

                            <a class="dropdown-item" href="<?= base_url('pesanan'); ?>">
                                <i class="fas fa-truck fa-sm fa-fw mr-2 text-gray-400"></i>
                                Pesanan Saya
                            </a>
                        <?php endif; ?>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="<?= base_url('change-password'); ?>">
                            <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                            Ganti Password
                        </a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                <?php endif; ?>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logout">Anda yakin ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik Logout untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-sm border text-white mr-2" style="background-color: #333333;" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-sm border text-white" style="background-color: #c80000;" href="<?= base_url('auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?= $this->renderSection('content'); ?>

    <!-- Footer -->
    <footer class="footer_area section_padding_130_0" style="margin-bottom: -20px; background-color:#333333;">
        <div class="container">
            <div class="row">
                <!-- Single Widget-->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget">
                        <!-- Footer Logo-->
                        <div class="footer-logo mb-3">
                            <img src="<?= base_url() ?>/main-logo.png" style="width: 200px;" alt="">
                        </div>
                        <p style="margin-bottom: 50px; font-size: medium; color: #cccccc;">Jln. Raya Parung Bogor Kp. Jati, RT. 02/07, Parung, Kecamatan Parung, Kabupaten Bogor, Jawa Barat 16330.</p>
                        <!-- Copywrite Text-->
                        <!-- <div class="copywrite-text mb-5">
                            <p class="mb-0" style="color: #cccccc;">Dibuat<i class="lni-heart mr-1"></i>oleh<a class="ml-1" href="#" style="font-weight: 800; color: #ffffff;">radicreative</a></p>
                        </div> -->
                        <!-- Footer Social Area-->
                        <div class="footer_social_area">
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
                                <li><a href="<?= base_url('tentang/penjualan-perusahaan') ?>" style="font-size: medium; color: #cccccc;">Penjualan Perusahaan</a></li>
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
            <div class="copyright text-center form-control-sm text-gray-500">
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

<!-- Chat Admin -->
<a href="https://wa.me/6289657951760" class="btn btn-sm btn-success position-fixed" style="bottom: 20px; right: 20px; z-index: 9999;">
    <i class="fab fa-whatsapp"></i>&nbsp; Admin
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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