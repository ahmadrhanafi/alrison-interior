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
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Icon Website -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/main-icon.png" type="image/x-icon">
    <!-- Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<style>
    body {
        background-color: aliceblue;
    }

    .nav-item.active {
        background-color: rgb(100, 100, 100);
        color: #333333;
    }

    .collapse-item.active {
        font-weight: bold;
        background-color: rgb(100, 100, 100);
        color: #fff !important;
        border-radius: 5px;
    }

    .collapse-inner {
        background-color: #212529;
    }

    @media screen {

        div#content {
            overflow: hidden;
        }

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

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    $uri = service('uri');
    $segment1 = $uri->getSegment(1);
    $segment2 = $uri->getSegment(2);
    ?>

    <ul class="navbar-nav sidebar sidebar-dark accordion d-flex flex-column" style="background-color: #212529;" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-text mx-3 mt-2"><?= session()->get('username') ?></div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider mt-2">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= ($segment1 == 'dashboard') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider mt-3">

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Menu
        </div> -->

        <!-- Sidebar Item - Menu Produk -->
        <li class="nav-item <?= ($segment1 == 'daftar-produk') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('daftar-produk'); ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Produk</span></a>
        </li>

        <!-- Sidebar Item - Menu Konsumen -->
        <li class="nav-item <?= in_array($segment1, ['daftar-konsumen', 'admin']) ? 'active' : '' ?>">
            <a class="nav-link <?= in_array($segment1, ['daftar-konsumen', 'admin']) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="<?= in_array($segment1, ['daftar-konsumen', 'admin']) ? 'true' : 'false' ?>" aria-controls="collapsePages">
                <i class="fas fa-fw fa-users"></i>
                <span>Konsumen</span>
            </a>
            <div id="collapsePages" class="collapse <?= in_array($segment1, ['daftar-konsumen', 'admin']) ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="collapse-inner rounded py-2">
                    <h6 class="collapse-header">Kategori Konsumen</h6>
                    <a class="collapse-item <?= ($segment1 == 'daftar-konsumen' && !$segment2) ? 'active' : '' ?> text-gray-800" href="<?= base_url('daftar-konsumen'); ?>">Belum Punya Akun</a>
                    <a class="collapse-item <?= ($segment1 == 'admin' && $segment2 == 'konsumen') ? 'active' : '' ?> text-gray-800" href="<?= base_url('admin/konsumen'); ?>">Sudah Punya Akun</a>
                </div>
            </div>
        </li>

        <!-- Sidebar Item - Menu Transaksi -->
        <li class="nav-item <?= in_array($segment1, ['transaksi-manual', 'transaksi-website']) ? 'active' : '' ?>">
            <a class="nav-link <?= in_array($segment1, ['transaksi-manual', 'transaksi-website']) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
                aria-expanded="<?= in_array($segment1, ['transaksi-manual', 'transaksi-website']) ? 'true' : 'false' ?>" aria-controls="collapsePages">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTransaksi" class="collapse <?= in_array($segment1, ['transaksi-manual', 'transaksi-website']) ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="collapse-inner rounded py-2">
                    <h6 class="collapse-header">Kategori Transaksi</h6>
                    <a class="collapse-item <?= ($segment1 == 'transaksi-manual') ? 'active' : '' ?> text-gray-800" href="<?= base_url('transaksi-manual'); ?>" href="<?= base_url('transaksi-manual'); ?>">Secara Manual</a>
                    <a class="collapse-item <?= ($segment1 == 'transaksi-website') ? 'active' : '' ?> text-gray-800" href="<?= base_url('transaksi-website'); ?>" href="<?= base_url('transaksi-website'); ?>">Dari Website</a>
                </div>
            </div>
        </li>

        <!-- Sidebar Item - Menu Pesanan -->
        <li class="nav-item <?= ($segment1 == 'kelola-pesanan') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('kelola-pesanan'); ?>">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Pesanan</span></a>
        </li>

        <!-- Sidebar Item - Menu Karyawan -->
        <!-- <li class="nav-item mb-3">
            <a class="nav-link" href="404.html">
                <i class="fas fa-fw fa-users"></i>
                <span>Karyawan</span></a>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider mt-4">

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Setelan
        </div> -->

        <!-- Sidebar Item - Menu Pengaturan -->
        <li class="nav-item <?= in_array($segment1, ['profil-saya', 'change-password']) ? 'active' : '' ?>">
            <a class="nav-link <?= in_array($segment1, ['profil-saya', 'change-password']) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="<?= in_array($segment1, ['profil-saya', 'change-password']) ? 'true' : 'false' ?>" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Pengaturan</span>
            </a>
            <div id="collapseTwo" class="collapse <?= in_array($segment1, ['profil-saya', 'change-password']) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                    <a class="collapse-item <?= ($segment1 == 'profil-saya') ? 'active' : '' ?>" href="<?= base_url('profil-saya'); ?>">Kelola Profil</a>
                    <a class="collapse-item <?= ($segment1 == 'change-password') ? 'active' : '' ?>" href="<?= base_url('change-password'); ?>">Ganti Password</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider mt-4 d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <!-- <div class="text-center d-md-inline mt-auto mb-5">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div> -->


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="height: 80px; background-color:rgb(0, 80, 200)">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn bg-transparent d-md-none rounded-circle ml-2">
                    <i class="fa fa-bars" style="color: #c80000;"></i>
                </button>

                <a class="topbar-brand d-none d-sm-block" style="max-width: 10%;" href="<?= base_url('dashboard'); ?>">
                    <img src="<?= base_url() ?>/main-logo.png" class="main-logo" style="width: 180px; position: static;" alt="Alrison Interior">
                </a>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a> -->

                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Cari sesuatu berdasarkan menu..." aria-label="Search"
                                        aria-describedby="basic-addon2" name="keyword">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow mr-2">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- <span class="mr-2 d-none d-lg-inline text-white medium"><?= session()->get('nama_user'); ?>&nbsp;
                                    (<?= session()->get('level'); ?>)</span> -->
                            <img class="img-profile rounded-circle"
                                src="<?= base_url(); ?>/profile/<?= session()->get('gambar_user'); ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('profil-saya'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <?= session()->get('nama_user'); ?>
                            </a>
                            <a class="dropdown-item" href="<?= base_url('change-password'); ?>">
                                <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ganti Password
                            </a>
                            <!-- <a class="dropdown-item" href="404.html">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
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
                            <h5 class="modal-title" id="logout" style="color: #333333;">Anda yakin ingin Logout?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Logout untuk mengakhiri sesi Anda saat ini.</div>
                        <div class="modal-footer">
                            <button class="btn btn-sm text-white" style="background-color: #333333;" type="button" data-dismiss="modal">Kembali</button>
                            <a class="btn btn-sm text-white" style="background-color: #c80000;" href="<?= base_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <?= $this->renderSection('content'); ?>

            <!-- Footer -->
            <footer class="fixed-sm-bottom mt-5">
                <div class="form-control-sm mb-4">
                    <div class="copyright text-center">
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
    <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url(); ?>/js/demo/chart-pie-demo.js"></script>

</html>