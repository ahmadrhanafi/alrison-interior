<?= $this->extend('layout/statis'); ?>
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

<div class="container">
    <div class="mt-4 mb-4" style="color: #333333;">
        <h5 class="fw-bold">Hasil pencarian untuk: "<?= esc($keyword) ?>"</h5>

        <?php if (session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success mt-4"><?= session()->getFlashdata('sukses') ?></div>
        <?php endif ?>
    </div>

    <?php if (count($produk) > 0): ?>
        <div class="row mb-5">
            <?php foreach ($produk as $p): ?>
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

                        <div class="card-body" style="padding: 10px;">
                            <h6 class="card-title mb-1" style="font-size: medium; font-weight: 500;"><strong><?= $p['nama_produk']; ?></strong></h6>
                            <span class="text-muted small"><?= $p['kategori']; ?></span>
                            <h6 class="text-success mt-1" style=" font-weight: 600;"><strong>Rp<?= number_format($p['harga'], 0, ',', '.') ?></strong></h6>
                        </div>
                        <p class="text-end text-gray-500 small mb-3 mr-4">Stok: <?= $p['stok']; ?></p>
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
        </div>
    <?php else: ?>
        <div class="mb-5">
            <p>Tidak ditemukan produk yang sesuai.</p>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   // tutup alert
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 300);
        });
    }, 3000);
</script>

<?= $this->endSection(); ?>