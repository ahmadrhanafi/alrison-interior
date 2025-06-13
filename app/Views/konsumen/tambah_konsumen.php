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
    <link rel="shortcut icon" href="<?= base_url(); ?>/main-icon.png" type="image/x-icon">

</head>


<body>

    <style>
        @media screen {

            a#debug-icon-link,
            #debug-icon {
                display: none;
            }
        }
    </style>

    <div id="topbar">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar static-top shadow" style="height: 80px; background-color:rgb(0, 80, 200);">

            <!-- Topbar - Brand -->

            <a class="topbar-brand w-25" style="max-width: 10%;" href="<?= base_url() ?>toko">
                <img src="<?= base_url(); ?>/main-logo.png" class="main-logo" style="width: 180px; position: static;" alt="Alrison Interior">
            </a>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <span class="mr-2 d-none d-lg-inline text-white medium"><?= session()->get('nama_user'); ?>&nbsp;
                (<?php if (session()->get('level') == 1) {
                        echo 'Admin';
                    } else if (session()->get('level') == 2) {
                        echo 'Konsumen';
                    }   ?>)
            </span> -->
                        <img class="img-profile rounded-circle"
                            src="<?= base_url(); ?>/profile/<?= session()->get('gambar_user'); ?>">
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?= session()->get('nama_user'); ?>
                        </a>
                        <a class="dropdown-item" href="404.html">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="auth/logout" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
    </div>

    <div class="container">
        <di class="row">
            <div class="col-10 mx-auto mt-4">
                <h2 class="py-3">Tambah konsumen</h2>

                <form action="simpan_konsumen" method="post">
                    <input type="hidden" class="form-control" id="id_konsumen" name="id_konsumen">
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label for="namaKonsumen" class="form-label">Nama konsumen</label>
                        <input type="text" class="form-control" id="namaKonsumen" name="nama_konsumen" required autofocus>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="transaksi" class="form-label">Transaksi</label>
                        <input type="text" class="form-control" id="transaksi" name="transaksi">
                    </div> -->
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor Handphone</label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat" style="height: 100px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>

                </form>
            </div>
        </di>
    </div>

    <!-- Footer -->
    <footer class="fixed-sm-bottom mt-5">
        <div class="container my-auto form-control-sm">
            <div class="copyright text-center my-auto">
                <small><span>environment : demo</span></small><br>
                <small><span>Copyright &copy; 2025 <b>Alrison Interior.</b> All rights reserved</span></small>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</body>

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
<!-- Custom scripts for all pages-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>