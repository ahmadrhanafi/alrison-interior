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

        .card {
            white-space: pre;
        }
    </style>

    <div id="topbar">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar static-top shadow" style="height: 80px; background-color:rgb(0, 80, 200);">

            <!-- Topbar - Brand -->

            <a class="topbar-brand w-25" style="max-width: 10%;" href="<?= base_url('dashboard') ?>">
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
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>

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
                    <div class="modal-body">Pilih "Logout" di bawah untuk mengakhiri sesi Anda saat ini.</div>
                    <div class="modal-footer">
                        <button class="btn text-white mr-2" style="background-color: #333333;" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn text-white" style="background-color: #c80000;" href="<?= base_url('logout') ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Topbar -->

    <div class="container mt-5" style="color: #333333;">

        <?php
        $warna = 'bg-secondary';
        if ($pesanan['status'] == 'Menunggu Pembayaran') $warna = 'bg-warning';
        elseif ($pesanan['status'] == 'Diproses') $warna = 'bg-info';
        elseif ($pesanan['status'] == 'Dikirim') $warna = 'bg-primary';
        elseif ($pesanan['status'] == 'Selesai') $warna = 'bg-success';
        elseif ($pesanan['status'] == 'Dibatalkan') $warna = 'bg-danger';
        ?>

        <h6><b>Detail Pesanan&#9;: #<?= $pesanan['kode_pesanan'] ?></b></h6>

        <div class="card mt-4 p-4">
            <p>Tanggal&#9;&#9;&#9;&#9;: <?= date('d-m-Y H:i', strtotime($pesanan['created_at'])) ?></p>
            <p>Nama Pemesan&#9;&#9;: <?= $pesanan['nama_pemesan'] ?></p>
            <p>Alamat Pengiriman&#9;: <?= $pesanan['alamat_pengiriman'] ?></p>
            <p>Status Pesanan&#9;&#9;: <span class="badge <?= $warna ?>"><?= $pesanan['status']; ?></span></p>
        </div>

        <h6 class="mt-3"><b>Rincian Pesanan</b></h6>

        <table class="table table-bordered mt-3">
            <thead style="background-color: #333333; color: white;">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($detailPesanan as $dp) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $dp['nama_produk'] ?></td>
                        <td><?= $dp['jumlah'] ?></td>
                        <td>Rp<?= number_format($dp['harga'], 0, ',', '.') ?></td>
                        <td>Rp<?= number_format($dp['harga'] * $dp['jumlah'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            <a href="<?= base_url('/kelola_pesanan'); ?>" class="btn btn-sm text-white rounded" style="background-color: #333333;">Kembali</a>
        </div>

    </div>

    <!-- Footer -->
    <footer class="fixed-sm-bottom mt-5">
        <div class="form-control-sm mb-4">
            <div class="copyright text-center">
                <!-- <small><span>environment : demo</span></small><br> -->
                <small><span>Copyright &copy; 2025 <b>Alrison Interior.</b> All Rights Reserved</span></small>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

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

</body>

</html>