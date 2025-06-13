<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= esc($title); ?></title>

    <!-- FontAwesome -->
    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" />
    <!-- Google Fonts Nunito -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet" />
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet" />
    <link rel="shortcut icon" href="<?= base_url('main-icon.png') ?>" type="image/x-icon" />

    <style>
        body {
            background-color: aliceblue;
            padding-top: 80px;

        }

        div#debug-icon {
            display: none;
        }

        .card {
            box-shadow: 0 20px 27px rgb(0 0 0 / 5%);
            border-radius: 1rem;
            background-color: #fff;
        }

        @media print {

            footer,
            .copyright,
            .title,
            .btn,
            nav.navbar {
                display: none !important;
            }

            a#debug-icon-link,
            footer {
                display: none;
            }
        }
    </style>

</head>

<body>

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light fixed-top shadow" style="height: 80px; background-color: rgb(0, 80, 200);">
        <a class="navbar-brand" href="<?= base_url('toko') ?>">
            <img src="<?= base_url('main-logo.png') ?>" alt="Alrison Interior" style="width: 150px;" />
        </a>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown no-arrow">
                <?php if (!session()->has('level')) : ?>
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bars fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('auth/login') ?>"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('auth/register') ?>"><i class="fas fa-user-plus me-2"></i>Register</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('kontak') ?>"><i class="fas fa-phone me-2"></i>Kontak</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('tentang') ?>"><i class="fas fa-info-circle me-2"></i>Tentang</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('dukungan') ?>"><i class="fas fa-hands-helping me-2"></i>Dukungan</a></li>
                    </ul>
                <?php else : ?>
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="<?= base_url('profile/' . session('gambar_user')) ?>" alt="Profile" style="width: 35px; height: 35px;" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('profile_saya') ?>"><i class="fas fa-user me-2 text-gray-500"></i><?= esc(session('nama_user')) ?></a></li>
                        <?php if (session('level') == 2) : ?>
                            <li><a class="dropdown-item" href="<?= base_url('keranjang') ?>">
                                    <i class="fas fa-shopping-cart me-2 text-gray-500"></i>
                                    Keranjang&nbsp;
                                    <span class="badge badge-danger badge-circle"><?= $totalItem; ?></span>
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('pesanan') ?>"><i class="fas fa-truck me-2 text-gray-500"></i>Pesanan Saya</a></li>
                        <?php endif; ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('change-password') ?>"><i class="fas fa-cog me-2 text-gray-500"></i>Ganti Password</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt me-2 text-gray-500"></i>Logout</a></li>
                    </ul>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true" aria-labelledby="logoutModalLabel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="logoutModalLabel" class="modal-title">Anda yakin ingin Logout?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Klik Logout untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mt-1" style="color: #333;">Detail Pesanan</h5>
            <button onclick="window.print()" class="btn btn-sm border btn-primary" style="background-color: rgb(0, 80, 200);">Cetak</button>
        </div>

        <div class="card p-4 mb-5">

            <div class="text-muted">
                <h2 class="fw-bold mb-1" style="color: #c00000;">Alrison Interior</h2>
                <p>Jln. Raya Parung Bogor, Kp. Jati Rt. 03/03, Parung, Jawa Barat, Indonesia 16330.</p>
                <p style="margin-top: -15px;"><a href="mailto:alrisoninterior00@gmail.com">alrisoninterior00@gmail.com</a></p>
                <p style="margin-top: -15px;">Telp: 089526336995</p>
            </div>

            <hr>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <h5>Detail Pemesan:</h5>
                    <h5><strong><?= esc($pesanan['nama_pemesan']); ?></strong></h5>
                    <p style="margin-top: -5px;"><?= esc($pesanan['alamat_pengiriman']); ?></p>
                    <p style="margin-top: -10px;"><?= esc($pesanan['no_hp']); ?></p>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <h5>Nomor Pesanan:</h5>
                    <p>#<?= esc($pesanan['kode_pesanan']); ?></p>
                    <h5>Tanggal Memesan:</h5>
                    <p><?= esc($pesanan['created_at']); ?></p>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mt-3 mb-3">Ringkasan Pesanan</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th>Gambar</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $grandTotal = 0;
                        foreach ($detail as $d) :
                            $subtotal = $d['harga'] * $d['jumlah'];
                            $grandTotal += $subtotal;
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <img src="<?= base_url('uploads/' . $d['gambar']) ?>" alt="<?= esc($d['nama_produk']) ?>" class="img-fluid rounded" style="max-width: 80px;" />
                                </td>
                                <td class="text-start">
                                    <strong style="font-size: 1rem;"><?= esc($d['nama_produk']) ?></strong><br />
                                    <small class="text-muted"><?= esc($d['kategori']) ?></small>
                                </td>
                                <td>Rp<?= number_format($d['harga'], 0, ',', '.') ?></td>
                                <td><?= esc($d['jumlah']) ?></td>
                                <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th colspan="5" class="text-end">Total</th>
                            <th>Rp<?= number_format($grandTotal, 0, ',', '.') ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <?php if ($pesanan['status'] == 'Menunggu Pembayaran' || $pesanan['status'] == 'Dibatalkan') : ?>
                    <a href="<?= base_url('pesanan/hapus/' . $pesanan['id_pesanan']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')"
                        class="btn btn-sm border btn-danger" style="font-size: small;" title="Hapus Pesanan">
                        <i class="fa fa-trash mt-1"></i>
                    </a>
                <?php endif; ?>
                <button class="btn btn-sm border btn-primary" style="background-color: rgb(0, 80, 200);" onclick="simpanPesanan()">Simpan</button>
                <?php if ($pesanan['status'] != 'Selesai') : ?>
                    <button id="pay-button" class="btn btn-sm border btn-success" style="background-color: rgb(0, 200, 100);">Bayar</button>
                <?php endif; ?>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center text-muted py-3">
        <small>Copyright &copy; 2025 <strong>Alrison Interior.</strong> All Rights Reserved</small>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert
        function simpanPesanan() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Pesanan tersimpan di menu pesanan kamu.',
                // confirmButtonText: 'OK',
                showConfirmButton: false,
                timer: 2000,
                willClose: () => {
                    window.location.href = '<?= base_url('pesanan') ?>';
                }
            });
        }

        // PaymentMidtrans
        document.getElementById('pay-button')?.addEventListener('click', function() {
            fetch('<?= base_url("pesanan/token/" . $pesanan['id_pesanan']) ?>')
                .then(response => response.json())
                .then(data => {
                    snap.pay(data.token, {
                        onSuccess: function(result) {
                            window.location.href = "<?= base_url('pesanan?success=1') ?>";
                        },
                        onPending: function(result) {
                            alert('Menunggu pembayaran!');
                            console.log(result);
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal!');
                            console.log(result);
                        }
                    });
                });
        });
    </script>

</body>

</html>