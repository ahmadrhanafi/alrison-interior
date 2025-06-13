<?= $this->extend('layout/dashboard'); ?>
<?= $this->section('content'); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Icon Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    @media print {
        h5.mb-0 {
            margin-top: 50px;
        }

        select {
            margin-top: 20px;
        }

        .card {
            margin-top: 20px;
            padding: 20px;
        }

        .card-img-top,
        div.row.my-3,
        .text-muted,
        .sidebar,
        #accordionSidebar,
        .sidebar-brand,
        .sidebar-divider,
        .sidebar-heading,
        #sidebarToggle,
        h6.text-white,
        h5.text-center,
        h6.fw-bold,
        h6.mt-2,
        h6.mt-4,
        h6.mb-3,
        h6.mt-1,
        button.btn,
        div.row.justify-content-center,
        hr,
        input.form-control,
        .navbar-nav,
        .input-group,
        .btn,
        .banner,
        button .btn-sm,
        .export,
        .pagination,
        footer,
        a#debug-icon-link {
            display: none !important;
        }

        .content-wrapper,
        .main-content {
            margin-left: 0 !important;
            width: 100% !important;
        }
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 text-dark">Dashboard</h5>
        <button onclick="print()" class="btn btn-sm btn-primary text-white">
            Cetak PDF
        </button>
    </div>

    <!-- Flash Messages -->
    <?php if (!empty(session()->getFlashdata('errors'))) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('sukses') ?></div>
    <?php endif ?>

    <!-- Filter Form -->
    <form action="<?= base_url('dashboard') ?>" method="get" class="row g-2 mb-4">
        <div class="col-auto">
            <select name="bulan" class="form-select form-select-sm shadow-sm">
                <?php for ($i = 1; $i <= 12; $i++) : ?>
                    <option value="<?= $i ?>" <?= ($i == date('n')) ? 'selected' : '' ?>>
                        <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-auto">
            <select name="tahun" class="form-select form-select-sm shadow-sm">
                <?php for ($t = 2025; $t <= date('Y'); $t++) : ?>
                    <option value="<?= $t ?>" <?= ($t == date('Y')) ? 'selected' : '' ?>>
                        <?= $t ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-sm btn-primary text-white shadow-sm">
                Tampilkan
            </button>
        </div>
    </form>

    <!-- Info Cards -->
    <div class="row">
        <?php
        $cards = [
            ['title' => 'Saldo', 'value' => 'Rp' . number_format($saldo, 0, ',', '.'), 'icon' => 'fa-wallet'],
            ['title' => 'Penjualan', 'value' => 'Rp' . number_format($penjualan, 0, ',', '.'), 'icon' => 'fa-coins'],
            ['title' => 'Pengeluaran', 'value' => 'Rp' . number_format($pengeluaran, 0, ',', '.'), 'icon' => 'fa-search-dollar'],
            ['title' => 'Stok Barang', 'value' => $stok, 'icon' => 'fa-box'],
            ['title' => 'Konsumen', 'value' => $konsumen, 'icon' => 'fa-users'],
            ['title' => 'Pesanan', 'value' => $pesanan, 'icon' => 'fa-boxes'],
        ];

        foreach ($cards as $card) : ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-xs fw-bold text-uppercase text-gray-500 mb-1"><?= $card['title'] ?></div>
                                <div class="h5 mb-0 fw-bold text-gray-800"><?= $card['value'] ?></div>
                            </div>
                            <i class="fas <?= $card['icon'] ?> fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <hr>

    <!-- Preview Toko -->
    <h5 class="text-center fw-bold text-dark">Preview Halaman Toko</h5>
    <hr>

    <!-- Banner Promo -->
    <h6 class="fw-bold text-dark mt-4">Banner Promo Saat Ini</h6>
    <div class="row my-3">
        <?php if (!empty($banner)) : ?>
            <?php foreach ($banner as $file) : ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <img src="<?= base_url('uploads/banner/' . $file) ?>" class="card-img-top" alt="Banner Promo">
                        <div class="card-body text-center banner">
                            <a href="<?= base_url('/dashboard/deleteBanner/' . $file) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus banner ini?')">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-info">Belum ada banner promo yang terpasang.</div>
            </div>
        <?php endif ?>
    </div>

    <hr>

    <!-- Upload Banner -->
    <h6 class="fw-bold text-dark">Upload Banner Promo</h6>
    <form action="<?= base_url('banner') ?>" method="post" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <input type="file" name="banner" class="form-control" accept="image/*">
            <span class="text-muted small">Rekomendasi ukuran banner 1600 x 600</span>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-sm text-white" style="background-color: rgb(0, 80, 200);">
                <i class="fa fa-arrow-alt-circle-up me-1"></i> Upload
            </button>
        </div>
    </form>

    <hr>

    <!-- Produk Toko -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="fw-bold text-dark mt-2">Daftar Produk Toko</h6>
        <a href="tambah_produk" class="btn btn-sm text-white" style="background-color: rgb(0, 80, 200);">
            <i class="fa fa-plus-circle me-1"></i> Produk
        </a>
    </div>

    <div class="row justify-content-center mt-3">
        <?php foreach ($produk as $p) : ?>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                <div class="card h-100">
                    <a href="produk/<?= $p['slug']; ?>">
                        <img src="<?= base_url('uploads/') . $p['gambar']; ?>" class="card-img-top" alt="<?= $p['gambar']; ?>">
                    </a>
                    <div class="card-body p-2">
                        <h6 class="card-title text-dark mb-1"><?= $p['nama_produk']; ?></h6>
                        <p class="mb-1 text-muted small"><?= $p['kategori']; ?></p>
                        <p class="mb-1 fw-semibold small text-dark">Rp<?= number_format($p['harga'], 0, ',', '.') ?></p>
                        <p class="mb-1 text-muted small">Stok: <?= $p['stok']; ?></p>
                    </div>
                    <div class="d-flex justify-content-between p-2">
                        <form action="edit_produk/<?= $p['id_produk']; ?>" method="get">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-sm btn-warning text-dark">Ubah</button>
                        </form>
                        <form action="produk/<?= $p['id_produk']; ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapusnya?')">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4 mb-5">
        <?= $pager->links('produk', 'produk_pagination'); ?>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // tutup alert
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);
</script>

<?= $this->endSection(); ?>