<?= $this->extend('layout/detail'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: aliceblue;
    }

    .carousel .carousel-item {
        transition: none;
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
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        font-weight: bold;
        font-size: x-small;
    }
</style>

<div class="container px-4">
    <div class="d-sm-flex align-items-center justify-content-between mt-4">
        <h5 class="mb-0 fw-bold text-dark">Detail <?= $produk['nama_produk'] ?></h5>

        <?php if (session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success small mt-3">
                <?= session()->getFlashdata('sukses'); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col">
            <div class="card border-2 rounded-2 mb-4 mt-3 mx-auto">
                <div class="row g-0">
                    <!-- Carousel -->
                    <div class="col-md-5">
                        <?php
                        $jumlahGambar = 1 + count($gambarTambahan);
                        $carouselId = 'carouselProduk';
                        ?>
                        <div id="<?= $carouselId ?>" class="carousel slide <?= $jumlahGambar == 1 ? 'carousel-static' : '' ?>" data-bs-ride="false" data-bs-touch="true">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?= base_url('uploads/' . $produk['gambar']); ?>" class="d-block w-100 h-100 rounded" alt="gambar utama" style="height: 320px; object-fit: cover;">
                                    <?php if ($produk['stok'] <= 0): ?>
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); z-index: 10; border-radius: 0.375rem;">
                                            <span class="text-white fw-bold text-center fs-5">
                                                <i class="fas fa-exclamation-circle"></i><br>
                                                Stok Habis</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php foreach ($gambarTambahan as $gambar): ?>
                                    <div class="carousel-item">
                                        <img src="<?= base_url('uploads/' . $gambar['gambar']); ?>" class="d-block w-100 h-100 rounded" alt="gambar tambahan" style="height: 320px; object-fit: cover;">
                                        <?php if ($produk['stok'] <= 0): ?>
                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); z-index: 10; border-radius: 0.375rem;">
                                                <span class="text-white fw-bold fs-5">
                                                    Stok Habis</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if ($jumlahGambar > 1): ?>
                                <button class="carousel-control-prev" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Detail -->
                    <div class="col-md-7">
                        <div class="card-body px-4 py-4">
                            <p class="text-muted mb-1"><small><?= $produk['kategori']; ?></small></p>
                            <h5 class="text-dark"><?= $produk['nama_produk']; ?></h5>
                            <span class="text-muted deskripsi-preview" id="deskripsiText"><?= nl2br($produk['deskripsi']); ?></span>
                            <span id="toggleDeskripsi" class="toggle-btn">Selengkapnya</span>

                            <h5 class="mt-3 text-success"><strong>Rp<?= number_format($produk['harga'], 0, ',', '.') ?></strong></h5>
                            <p class="text-muted mb-3">Stok : <?= $produk['stok']; ?></p>

                            <div class="d-flex gap-2 mt-3">
                                <?php if ($produk['stok'] > 0): ?>
                                    <a href="<?= base_url('tambah-keranjang/' . $produk['id_produk']) ?>" class="btn btn-sm border text-white" style="background-color: rgb(0, 80, 200);">
                                        <i class="fas fa-plus" style="font-size: x-small;"></i>&nbsp; Keranjang
                                    </a>

                                    <a href="<?= base_url('order/' . $produk['slug']) ?>" class="btn btn-sm border text-white" style="background-color: rgb(0, 200, 100);">Buat Pesanan</a>
                                <?php else: ?>
                                    <a href="<?= base_url('tambah-keranjang/' . $produk['id_produk']) ?>" class="btn btn-secondary btn-sm border disabled">
                                        <i class="fas fa-plus" style="font-size: x-small;"></i>&nbsp; Keranjang
                                    </a>

                                    <button class="btn btn-sm border btn-secondary" disabled>Stok Habis</button>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <div class="p-4">
                        <h6>Bagikan Produk :</h6>

                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($produk['nama_produk'] . ' - ' . current_url()) ?>" target="_blank" class="btn btn-sm border text-white me-1" style="background-color: #075E54;">
                            <i class="bi bi-whatsapp"></i>
                        </a>

                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="btn btn-sm border text-white me-1" style="background-color: #4267B2;">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <button class="btn btn-sm border btn-secondary" onclick="copyLink()">Copy Link</button>
                    </div>
                </div>
            </div>

            <!-- Produk Terkait -->
            <h5 class="mt-4 mb-3 fw-bold text-dark">Produk Terkait</h5>
            <div class="row mb-5">
                <?php if (!empty($produkTerkait)) : ?>
                    <?php foreach ($produkTerkait as $p) : ?>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="img-wrapper">
                                    <a href="<?= base_url('detail-produk/' . $p['slug']) ?>">
                                        <img src="<?= base_url('uploads/' . $p['gambar']) ?>" class="card-img-top">
                                        <?php if ($p['stok'] <= 0): ?>
                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); z-index: 10; border-radius: 0.375rem;">
                                                <span class="text-white fw-bold text-center fs-6">
                                                    <i class="fas fa-exclamation-circle"></i><br>
                                                    Stok Habis</span>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="card-body">
                                    <h6 class="fw-semibold" style="margin-bottom: 0px;"><?= $p['nama_produk'] ?></h6>
                                    <span class="text-muted small"><?= $p['kategori']; ?></span>
                                    <p class="fs-6 text-success"><strong>Rp<?= number_format($p['harga'], 0, ',', '.') ?></strong></p>
                                </div>

                                <p class="text-end text-gray-600 small mb-3 mr-4" style="margin-top: -15px;">Stok: <?= $p['stok']; ?></p>
                                <div class="d-flex justify-content-between px-3 mb-3">
                                    <?php if ($p['stok'] > 0): ?>
                                        <a href="<?= base_url('tambah-keranjang/' . $produk['id_produk']) ?>" class="btn btn-sm text-white" style="background-color: #0050c8;"><i class="fas fa-cart-plus px-2"></i></a>
                                        <a href="<?= base_url('order/' . $p['slug']) ?>" class="btn btn-sm text-white" style="background-color: rgb(0, 200, 100);">Order</a>
                                    <?php else: ?>
                                        <a href="<?= base_url('tambah-keranjang/' . $produk['id_produk']) ?>" class="btn btn-sm btn-secondary disabled"><i class="fas fa-cart-plus px-2"></i></a>
                                        <button class="btn btn-sm btn-secondary" disabled>Habis</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada produk terkait saat ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Deskripsi toggle -->
<style>
    .deskripsi-preview {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 7;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
    }

    .toggle-btn {
        cursor: pointer;
        color: #0050c8;
        font-weight: 500;
    }
</style>

<script>
    // tutup alert
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);

    // deskripsi
    const deskripsi = document.getElementById('deskripsiText');
    const toggleBtn = document.getElementById('toggleDeskripsi');

    toggleBtn.addEventListener('click', function() {
        deskripsi.classList.toggle('deskripsi-preview');
        toggleBtn.textContent = deskripsi.classList.contains('deskripsi-preview') ? 'Selengkapnya' : 'Sembunyikan';
    });

    // copylink
    function copyLink() {
        navigator.clipboard.writeText("<?= current_url() ?>").then(() => {
            alert("Link berhasil disalin!");
        }).catch(() => {
            alert("Gagal menyalin link");
        });
    }
</script>

<?= $this->endSection(); ?>