<?= $this->extend('layout/web'); ?>

<?= $this->section('content'); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: aliceblue;
    }
</style>

<!-- Modal Login Reminder -->
<div class="modal fade" id="loginReminderModal" tabindex="-1" aria-labelledby="loginReminderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="loginReminderLabel">Akses Fitur</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Login untuk akses fitur : <br> <strong>Keranjang</strong> dan <strong>Order produk</strong>.</p>
                <a href="<?= base_url('auth/login') ?>" class="btn btn-primary mt-3">Login Sekarang</a>
            </div>
        </div>
    </div>
</div>

<!-- Say Hello! -->
<div class="container">

    <?php if (session()->getFlashdata('sukses')): ?>
        <div class="alert alert-success mt-4"><?= session()->getFlashdata('sukses') ?></div>
    <?php endif; ?>

    <div class="col-12 d-flex justify-content-end">
        <form method="get" action="<?= base_url('web') ?>" class="d-none d-md-block mt-4">
            <select name="kategori" onchange="submit()" class="form-select form-select-sm">
                <option value="#">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['kategori'] ?>" <?= ($k['kategori'] == $kategoriDipilih ? 'selected' : '') ?>>
                        <?= $k['kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
</div>
<!-- End Say -->

<!-- Banner promo -->
<div class="container mb-2 mt-4">
    <?php $jumlahBanner = !empty($banner) ? count($banner) : 0; ?>
    <div id="promoCarousel" class="carousel slide <?= $jumlahBanner > 1 ? '' : 'pointer-event-none' ?>" data-bs-ride="<?= $jumlahBanner > 1 ? 'carousel' : '' ?>">

        <!-- Slides -->
        <div class="carousel-inner rounded shadow">
            <?php if (!empty($banner)) : ?>
                <?php $i = 0;
                foreach ($banner as $file) : ?>
                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url('uploads/banner/' . $file) ?>" class="d-block w-100 img-fluid" alt="Promo">
                    </div>
                <?php $i++;
                endforeach; ?>
            <?php else : ?>
                <div class="carousel-item active">
                    <img src="<?= base_url('uploads/default.jpg') ?>" class="d-block w-100 img-fluid" alt="Default Promo">
                </div>
            <?php endif; ?>
        </div>

        <!-- Control -->
        <?php if ($jumlahBanner > 1) : ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Selanjutnya</span>
            </button>
        <?php endif; ?>

        <!-- Indicator (dipindah ke bawah carousel) -->
        <?php if ($jumlahBanner > 1) : ?>
            <div class="d-flex justify-content-center mt-3">
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < $jumlahBanner; $i++) : ?>
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<!-- Banner End -->

<!-- Modal Filter mobile -->
<div class="d-block d-md-none mb-3 d-flex justify-content-between">
    <div>
        <button class="btn btn-sm text-white mt-1" style="margin-left: 12px; background-color: rgb(0, 80, 200); height: 33px; padding: 3px 8px; font-size: small;" type="button" data-toggle="modal" data-target="#filterModal">
            <i class="fas fa-filter"></i> &nbsp;Filter
        </button>

        <a href="<?= base_url('web') ?>" class="btn btn-sm text-white mt-1" style="height: 33px; padding-top: 6px; font-size: small; background-color: #333333;"><i class="fas fa-redo"></i> &nbsp;Reset</a>
    </div>

    <form method="get" action="<?= base_url('web') ?>" class="d-block d-md-none mt-1" style="margin-right: 12px;">
        <select name="kategori" onchange="submit()" class="form-select form-select-sm">
            <option value="#">Semua Kategori</option>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['kategori'] ?>" <?= ($k['kategori'] == $kategoriDipilih ? 'selected' : '') ?>>
                    <?= $k['kategori'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #333333;" id="filterModalLabel">Filter Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="<?= base_url('web') ?>">
                    <div class="mb-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="<?= esc($keyword) ?>">
                    </div>
                    <div class="mb-3">
                        <input type="number" min="1" name="min_harga" class="form-control" placeholder="Minimum harga" value="<?= esc($minHarga) ?>">
                    </div>
                    <div class="mb-3">
                        <input type="number" min="1" name="max_harga" class="form-control" placeholder="Maksimum harga" value="<?= esc($maxHarga) ?>">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn text-white" style="background-color: rgb(0, 80, 200);">Filter</button>
                        <a href="<?= base_url('web') ?>" class="btn text-white" style="background-color: #333333;">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<div class="container">
    <div class="row d-flex justify-content-center">

        <!-- Filter Harga -->
        <div class="col-12 d-none d-md-block pt-3 pt-3">
            <form method="get" action="<?= base_url('web') ?>" class="mb-4">
                <div class="row g-2 justify-content-center">

                    <div class="col-12 col-md-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="<?= esc($keyword) ?>">
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="number" min="1" name="min_harga" class="form-control" placeholder="Min harga" value="<?= esc($minHarga) ?>">
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="number" min="1" name="max_harga" class="form-control" placeholder="Max harga" value="<?= esc($maxHarga) ?>">
                    </div>

                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn text-white w-100" style="background-color:rgb(0, 80, 200);">Filter</button>
                    </div>

                    <div class="col-6 col-md-2">
                        <a href="<?= base_url('web') ?>" class="btn text-white w-100" style="background-color: #333;">Reset</a>
                    </div>

                </div>
            </form>
        </div>
        <!-- End Filter Harga -->

        <!-- Produk Grid -->
        <?php foreach ($produk as $p) : ?>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                <div class="card h-100">
                    <a href="detail-produk/<?= $p['slug']; ?>">
                        <img src="<?= base_url('uploads/') . $p['gambar']; ?>" class="card-img-top" alt="<?= $p['gambar']; ?>">
                    </a>
                    <div class="card-body" style="padding: 12px;">
                        <h6 class="card-title mb-1" style="font-size: medium; font-weight: 500;"><strong><?= $p['nama_produk']; ?></strong></h6>
                        <span class="text-muted small"><?= $p['kategori']; ?></span>
                        <h6 class="text-success mt-1" style=" font-weight: 600;"><strong>Rp<?= number_format($p['harga'], 0, ',', '.') ?></strong></h6>
                    </div>
                    <p class="text-end text-gray-600 small mb-3 mr-4">Stok: <?= $p['stok']; ?></p>
                    <div class="d-flex justify-content-between mb-3 px-3">
                        <!-- <a href="detail-produk/<?= $p['slug']; ?>" class="btn btn-sm text-white" style="background-color:rgb(0, 80, 200);">Detail</a> -->
                        <?php if ($p['stok'] > 0): ?>
                            <a href="<?= base_url('tambah-keranjang/' . $p['id_produk']) ?>" class="btn btn-sm text-white" style="background-color: rgb(0, 80, 200);">
                                <i class="fas fa-cart-plus px-2" style="font-size: small;"></i>
                            </a>

                            <a href="order/<?= $p['slug']; ?>" class="btn btn-sm text-white" style="background-color: rgb(0, 200, 100);">Order</a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" onclick="tambahKeranjang()" disabled>
                                <i class="fas fa-cart-plus px-2" style="font-size: small; color: #fff;"></i>
                            </button>
                            
                            <button class="btn btn-secondary btn-sm" disabled>Habis</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- End Produk Grid -->

    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4 mb-5">
        <?= $pager->links('produk', 'produk_pagination'); ?>
    </div>
</div>

<!-- Gambar -->
<!-- <div class="container my-4">
    <div class="row align-items-center"> -->

<!-- Judul -->
<!-- <div class="col-12 col-md-6 mb-3 mb-md-0 text-center text-md-start">
            <h2 class="fw-bold">Mitra Kami</h2>
            <p class="text-muted">Nikmati berbagai pilihan furniture dengan kualitas terbaik dan harga bersaing. Cek sekarang!</p>
            <a href="<?= base_url('web') ?>" class="btn btn-primary mt-2">Lihat Produk</a>
        </div> -->

<!-- Gambar -->
<!-- <div class="col-12 col-md-6 text-center">
            <img src="<?= base_url('uploads/banner_promo.png') ?>" class="img-fluid rounded" alt="Promo Alrison Interior">
        </div>

    </div>
</div> -->

<!-- Services -->
<div class="container mb-3">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card media pt-4 px-4 w-100">
                <div class="col d-flex justify-content-center text-info mb-3">
                    <i class="fas fa-truck" style="font-size: 25px;"></i>
                </div>
                <div class="media-body pb-2" style="text-align: center;">
                    <h5 style="font-weight: 800; color: #333333;">Pengiriman Cepat</h5>
                    <p class="text-muted">
                        Barang yang dipesan akan dikirim menggunakan pick-up Alrison Interior.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card media pt-4 px-4 w-100">
                <div class="col d-flex justify-content-center text-warning mb-3">
                    <i class="fas fa-headset" style="font-size: 25px;"></i>
                </div>
                <div class="media-body pb-2" style="text-align: center;">
                    <h5 style="font-weight: 800; color: #333333;">Pelayanan Ramah</h5>
                    <p class="text-muted">
                        Kepuasan konsumen adalah prioritas yang paling utama bagi kami.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card media pt-4 px-4 w-100">
                <div class="col d-flex justify-content-center text-success mb-3">
                    <i class="fas fa-credit-card" style="font-size: 25px;"></i>
                </div>
                <div class="media-body pb-2" style="text-align: center;">
                    <h5 style="font-weight: 800; color: #333333;">Pembayaran Online</h5>
                    <p class="text-muted">
                        Barang yang dipesan dapat dibayar dengan cara online atau transfer.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Services -->

<!-- Mitra -->
<div class="container mx-auto mb-5">
    <div class="pt-3 px-3" style="background-color: white;">
        <div class="d-flex justify-content-center">
            <h5 style="font-weight: 800; color: #333333; padding-top: 10px;">Kemitraan Kami</h5>
        </div>

        <hr class="divider">

        <div class="d-flex justify-content-center pb-3">
            <img src="<?= base_url('uploads/banner_promo.png') ?>" class="img-fluid rounded" style="width: auto;" alt="Promo Alrison Interior">
        </div>
    </div>
</div>
<!-- End Mitra -->

<!-- Chat Admin -->
<a href="https://wa.me/6289657951760" class="btn btn-sm btn-success position-fixed" style="bottom: 20px; right: 20px; z-index: 9999;">
    <i class="fab fa-whatsapp"></i>&nbsp; Admin
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // tutup alert
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);

    // modal
    // document.addEventListener("DOMContentLoaded", function() {
    //     // if (!sessionStorage.getItem("loginReminderShown")) {
    //     setTimeout(function() {
    //         var myModal = new bootstrap.Modal(document.getElementById('loginReminderModal'));
    //         myModal.show();

    //         // Tandai sudah ditampilkan agar tidak muncul lagi
    //         // sessionStorage.setItem("loginReminderShown", "yes");
    //     }, 12000); // 2 menit

    // });
</script>

<?= $this->endSection(); ?>