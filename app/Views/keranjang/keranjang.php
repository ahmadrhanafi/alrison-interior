<?= $this->extend('layout/statis'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: aliceblue;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h5 class="fw-bold" style="color: #333;">Keranjang</h5>

        <a href="<?= base_url('toko'); ?>" class="mt-1" style="text-decoration: none; font-size: small;">
            <i class="fas fa-arrow-circle-left" style="font-size: small;"></i>&nbsp;Kembali ke Beranda
        </a>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success mt-4"><?= session()->getFlashdata('pesan') ?></div>
    <?php endif ?>

    <?php if (session()->getFlashdata('gagal')) : ?>
        <div class="alert alert-danger mt-4"><?= session()->getFlashdata('gagal') ?></div>
    <?php endif ?>

    <?php if (empty($keranjang)) : ?>
        <div class="p-3 bg-warning bg-opacity-10 border border-warning text-gray-800 rounded mt-4 mb-5">
            Keranjang kamu kosong ...
        </div>
    <?php else : ?>
        <div class="row mt-4">
            <?php $grandTotal = 0; ?>
            <?php foreach ($keranjang as $item) :
                $grandTotal += $item['total_harga'];
            ?>
                <div class="col-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center gap-3 flex-nowrap">
                            <!-- Gambar -->
                            <img src="<?= base_url('uploads/' . $item['gambar']) ?>" class="rounded" width="90" height="90" style="object-fit: cover; flex-shrink: 0;">

                            <!-- Detail Produk -->
                            <div class="flex-grow-1 overflow-hidden">
                                <h6 class="mb-1 text-truncate"><?= $item['nama_produk'] ?></h6>
                                <p class="mb-1 text-muted small">Harga: Rp<?= number_format($item['harga'], 0, ',', '.') ?></p>
                                <p class="mb-1 text-muted small">Jumlah: <?= $item['jumlah'] ?></p>
                                <p class="mb-0 fw-bold small">Total: Rp<?= number_format($item['total_harga'], 0, ',', '.') ?></p>
                            </div>

                            <!-- Tombol Hapus -->
                            <form action="<?= base_url('keranjang/hapus/' . $item['id_keranjang']) ?>" method="post"
                                onsubmit="return confirm('Hapus produk dari keranjang?')" class="position-absolute p-3" style="bottom: 0; right: 0;">
                                <?= csrf_field() ?>
                                <button class="btn btn-sm btn-danger border">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Total & Aksi -->
        <div class="card border-success mt-4 mb-4">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-2 mb-md-0">Total Belanja :</h6>
                <h5 class="text-success mb-2 mb-md-0">Rp<?= number_format($grandTotal, 0, ',', '.') ?></h5>
            </div>
        </div>

        <!-- <div class="d-flex flex-column flex-md-row gap-2 mb-5">
            <a href="<?= base_url('kosongkan-keranjang'); ?>" class="btn btn-warning text-black w-100 w-md-auto">Kosongkan Keranjang</a>
            <a href="<?= base_url('order-keranjang'); ?>" class="btn text-white w-100 w-md-auto" style="background-color: rgb(0, 200, 100);">Buat Pesanan</a>
        </div> -->

        <div class="d-flex justify-content-end mb-5">
            <a href="<?= base_url('kosongkan-keranjang'); ?>" class="btn btn-danger btn-sm text-white mr-2">Hapus Semua</a>
            <a href="<?= base_url('order-keranjang'); ?>" class="btn btn-sm text-white" style="background-color: rgb(0, 200, 100);">Buat Pesanan</a>
        </div>
    <?php endif; ?>
</div>

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