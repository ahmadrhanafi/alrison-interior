<?= $this->extend('layout/toko'); ?>
<?= $this->section('content'); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: aliceblue;
    }

    .img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .img-disabled {
        filter: brightness(30%);
    }

    .stok-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        font-weight: bold;
        font-size: x-small;
    }
</style>

<!-- Say Hello! -->
<div class="container">
    <div class="col-12 d-flex justify-content-between mt-4">
        <h8 style="font-size: 15px; margin-top: 5px; color: #333333;"><?= $ucapan ?>,&nbsp;<b><?= session()->get('nama_user'); ?></b></h8>

        <form method="get" action="<?= base_url('toko') ?>" class="d-none d-md-block">
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

    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success mt-4" role="alert">
            <?= session()->getFlashdata('sukses'); ?>
        </div>
    <?php endif; ?>
</div>
<!-- End Say -->



<!-- Banner promo -->
<div class="container mb-3 mt-4">
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
        <button class="btn btn-sm text-white mt-1" style="margin-left: 12px; background-color: rgb(0, 80, 200); height: 33px; padding-top: 6px; font-size: small;" type="button" data-toggle="modal" data-target="#filterModal">
            <i class="fas fa-filter"></i> &nbsp;Filter
        </button>

        <a href="<?= base_url('toko') ?>" class="btn btn-sm text-white mt-1" style="height: 33px; padding-top: 6px; font-size: small; background-color: #333333;"><i class="fas fa-redo"></i> &nbsp;Reset</a>
    </div>

    <form method="get" action="<?= base_url('toko') ?>" class="d-block d-md-none mt-1" style="margin-right: 12px;">
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
                <form method="get" action="<?= base_url('toko') ?>">
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
                        <a href="<?= base_url('toko') ?>" class="btn text-white" style="background-color: #333333;">Reset</a>
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
            <form method="get" action="<?= base_url('toko') ?>" class="mb-4">
                <div class="row g-2 justify-content-center">

                    <div class="col-12 col-md-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari produk dengan filter harga..." value="<?= esc($keyword) ?>">
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="number" min="1" name="min_harga" class="form-control" placeholder="Min harga" value="<?= esc($minHarga) ?>">
                    </div>

                    <div class="col-6 col-md-2">
                        <input type="number" min="1" name="max_harga" class="form-control" placeholder="Max harga" value="<?= esc($maxHarga) ?>">
                    </div>

                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn border text-white w-100" style="background-color:rgb(0, 80, 200);">Filter</button>
                    </div>

                    <div class="col-6 col-md-2">
                        <a href="<?= base_url('toko') ?>" class="btn border text-white w-100" style="background-color: #333;">Reset</a>
                    </div>

                </div>
            </form>
        </div>
        <!-- End Filter Harga -->

        <!-- Produk Grid -->
        <?php foreach ($produk as $p) : ?>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                <div class="card h-100">
                    <div class="img-wrapper position-relative">
                        <a href="<?= base_url('detail-produk/') . $p['slug']; ?>">
                            <img src="<?= base_url('uploads/') . $p['gambar']; ?>" class="card-img-top <?= ($p['stok'] <= 0) ? 'img-disabled' : '' ?>" alt="<?= $p['gambar']; ?>">
                            <?php if ($p['stok'] <= 0) : ?>
                                <div class="stok-overlay text-center">
                                    <i class="fas fa-exclamation-circle"></i><br>
                                    Stok Habis
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>

                    <div class="card-body" style="padding: 12px;">
                        <h6 class="card-title mb-1" style="font-size: medium; font-weight: 500;"><strong><?= $p['nama_produk']; ?></strong></h6>
                        <span class="text-muted small"><?= $p['kategori']; ?></span>
                        <h6 class="text-success mt-1" style=" font-weight: 600;"><strong>Rp<?= number_format($p['harga'], 0, ',', '.') ?></strong></h6>
                    </div>

                    <p class="text-end text-gray-600 small mb-3 mr-4">Stok: <?= $p['stok']; ?></p>
                    <div class="d-flex justify-content-between mb-3 px-3">
                        <?php if ($p['stok'] > 0): ?>
                            <a href="<?= base_url('tambah-keranjang/' . $p['id_produk']) ?>" class="btn btn-sm text-white" style="background-color: rgb(0, 80, 200);">
                                <i class="fas fa-cart-plus px-2" style="font-size: small;"></i>
                            </a>

                            <a href="order/<?= $p['slug']; ?>" class="btn btn-sm text-white" style="background-color: rgb(0, 200, 100);">Order</a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>
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

<!-- Services -->
<div class="container mb-3">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card media pt-4 px-4 w-100">
                <div class="col d-flex justify-content-center text-info mb-3">
                    <i class="fas fa-truck" style="font-size: 25px;"></i>
                </div>
                <div class="media-body pb-2" style="text-align: center;">
                    <h5 style="font-weight: 800; color: #333333;">Pengiriman Murah</h5>
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
                    <h5 style="font-weight: 800; color: #333333;">Pembayaran Mudah</h5>
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
    <div class="pt-3 px-3 border border-2 rounded" style="background-color: white;">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // tutup alert
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<?= $this->endSection(); ?>