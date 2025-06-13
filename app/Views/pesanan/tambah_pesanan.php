<?= $this->extend('layout/simple'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-4">
        <h5 class="fw-bold mb-2" style="color: #333;">Buat Pesanan</h5>
    </div>

    <?php if (session()->getFlashdata('gagal')) : ?>
        <div class="alert alert-danger mt-1">
            <?= session()->getFlashdata('gagal'); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($keranjang) && count($keranjang) > 0) : ?>
        <?php foreach ($keranjang as $item) : ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 flex-nowrap">
                    <!-- Gambar Produk -->
                    <img src="<?= base_url('uploads/' . $item['gambar']); ?>" class="rounded" width="90" height="90" style="object-fit: cover; flex-shrink: 0;" alt="<?= $item['gambar']; ?>">

                    <!-- Detail Produk -->
                    <div class="flex-grow-1 overflow-hidden">
                        <h6 class="mb-1 text-truncate"><?= $item['nama_produk']; ?></h6>
                        <p class="mb-1 text-muted small">Jumlah: <?= $item['jumlah']; ?></p>
                        <p class="mb-1 text-muted small">Harga: Rp<?= number_format($item['harga'], 0, ',', '.') ?></p>
                        <p class="mb-0 fw-bold small">Total: Rp<?= number_format($item['total_harga'], 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <?php elseif (isset($produk)) : ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3 flex-nowrap">
                <!-- Gambar Produk -->
                <img src="<?= base_url('uploads/' . $produk['gambar']); ?>" class="rounded" width="90" height="90" style="object-fit: cover; flex-shrink: 0;" alt="<?= $produk['gambar']; ?>">

                <!-- Detail Produk -->
                <div class="flex-grow-1 overflow-hidden">
                    <h6 class="mb-1 text-truncate"><?= $produk['nama_produk']; ?></h6>
                    <p class="mb-1 text-muted small">Harga: Rp<?= number_format($produk['harga'], 0, ',', '.') ?></p>
                    <p class="mb-0 text-muted small">Stok: <?= $produk['stok']; ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('simpan_pesanan') ?>" method="post">
        <?= csrf_field(); ?>
        <?php if (isset($produk)) : ?>
            <input type="hidden" name="tipe_pesanan" value="satuan">
            <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
            <div class="mb-3">
                <label class="form-label">Jumlah Order</label>
                <div class="input-group" style="max-width: 140px;">
                    <button type="button" class="btn btn-outline-secondary px-3" id="btn-minus"><i class="fas fa-minus" style="font-size: small;"></i></button>
                    <input
                        type="text"
                        class="form-control text-center"
                        id="jumlah"
                        name="jumlah"
                        value="1"
                        style="max-width: 60px;"
                        required>
                    <button type="button" class="btn btn-outline-secondary px-3" id="btn-plus"><i class="fas fa-plus" style="font-size: small;"></i></button>
                </div>
                <small class="text-muted">Stok yang tersedia : <?= $produk['stok']; ?></small>
            </div>
        <?php else : ?>
            <input type="hidden" name="tipe_pesanan" value="keranjang">
        <?php endif; ?>

        <div class="mb-3 mt-5">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control" name="nama_pemesan" placeholder="Masukkan nama pemesan" value="<?= old('nama_pemesan') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor Handphone</label>
            <input type="number" min="1" class="form-control" name="no_hp" placeholder="Masukkan nomor yang bisa dihubungi" value="<?= old('no_hp') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat Pengiriman</label>
            <input type="text" class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat pengiriman lengkap" value="<?= old('alamat_pengiriman') ?>" required>
        </div>

        <div class="d-flex justify-content-end mb-4">
            <a href="<?= base_url('toko'); ?>" class="btn btn-danger btn-sm mr-3">Kembali</a>
            <button type="submit" class="btn btn-success btn-sm">Selanjutnya</button>
        </div>
    </form>
</div>

<?php if (isset($produk)) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahInput = document.getElementById('jumlah');
            const btnMinus = document.getElementById('btn-minus');
            const btnPlus = document.getElementById('btn-plus');
            const stok = <?= $produk['stok']; ?>;

            btnMinus.addEventListener('click', function() {
                let value = parseInt(jumlahInput.value) || 1;
                if (value > 1) {
                    jumlahInput.value = value - 1;
                }
            });

            btnPlus.addEventListener('click', function() {
                let value = parseInt(jumlahInput.value) || 1;
                if (value < stok) {
                    jumlahInput.value = value + 1;
                }
            });

            jumlahInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                let value = parseInt(this.value);
                if (value > stok) {
                    this.value = stok;
                } else if (value < 1 || isNaN(value)) {
                    this.value = 1;
                }
            });
        });
    </script>
<?php endif; ?>

<?= $this->endSection(); ?>