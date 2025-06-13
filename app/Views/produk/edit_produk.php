<?= $this->extend('layout/simple'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-12 mx-auto mt-4">
            <h2 class="py-3">Edit Produk</h2>

            <!-- Preview semua gambar lama -->
            <div class="row mt-3">
                <label class="form-label fw-semibold" style="margin-bottom: 20px;">Gambar Produk Saat Ini:</label>

                <!-- Gambar Utama -->
                <div class="col-6 col-sm-4 col-md-3 mb-3 text-center">
                    <img src="<?= base_url('uploads/' . $produk['gambar']) ?>" 
                         class="img-thumbnail rounded" style="height: 150px; object-fit: cover;" 
                         alt="Gambar Utama">
                    <small class="text-muted d-block mt-1">Gambar Utama</small>
                </div>

                <!-- Gambar Tambahan -->
                <?php if (!empty($gambar_tambahan)) : ?>
                    <?php foreach ($gambar_tambahan as $gambar): ?>
                        <div class="col-6 col-sm-4 col-md-3 mb-3 text-center">
                            <img src="<?= base_url('uploads/' . $gambar['gambar']) ?>" 
                                 class="img-thumbnail rounded" style="height: 150px; object-fit: cover;" 
                                 alt="Gambar Tambahan">
                            <form action="<?= base_url('hapus_gambar/' . $gambar['id_gambar']) ?>" method="post" onsubmit="return confirm('Yakin hapus gambar ini?');">
                                <?= csrf_field() ?>
                                <button class="btn btn-danger btn-sm mt-2 w-75" type="submit">Hapus</button>
                            </form>
                        </div>
                    <?php endforeach ?>
                <?php endif; ?>
            </div>

            <hr>
            
            <!-- Form Edit -->
            <form action="<?= base_url('edit_produk/update_produk') ?>" method="post" enctype="multipart/form-data" class="mt-4">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                <input type="hidden" name="slug" value="<?= $produk['slug']; ?>">
                <input type="hidden" name="gambar_lama" value="<?= $produk['gambar']; ?>">

                <!-- Preview gambar baru -->
                <div class="row" id="preview-semua-gambar"></div>

                <!-- Input gambar -->
                <div class="mb-4">
                    <label for="semua_gambar" class="form-label fw-semibold">Upload Gambar</label>
                    <input type="file" class="form-control" id="semua_gambar" name="semua_gambar[]" multiple accept="image/*">
                    <small class="text-muted d-block mt-1">Gambar pertama akan menjadi gambar utama, sisanya gambar tambahan.</small>
                </div>

                <!-- Input nama produk -->
                <div class="mb-3">
                    <label for="namaProduk" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" class="form-control" id="namaProduk" maxlength="50" name="nama_produk" value="<?= esc($produk['nama_produk']); ?>" required>
                </div>

                <!-- Input kategori -->
                <div class="mb-3">
                    <label for="kategori" class="form-label fw-semibold">Kategori</label>
                    <select class="form-select" name="kategori" id="kategori" required>
                        <option value="" disabled <?= $produk['kategori'] ? '' : 'selected' ?>>-- Pilih Kategori --</option>
                        <?php
                        $kategoriList = [
                            'Sofa', 'Kasur', 'Jemuran', 'Buffet TV', 'Buffet Pajangan',
                            'Bantal dan Selimut', 'Dipan Ranjang', 'Kursi Bar', 'Kursi Teras',
                            'Kursi Kantor', 'Meja Rias', 'Meja Belajar', 'Meja Kantor',
                            'Meja Makan', 'Rak Buku', 'Rak Piring', 'Rak Sepatu',
                            'Lemari Arsip', 'Lemari Pakaian'
                        ];
                        foreach ($kategoriList as $kat) :
                        ?>
                            <option value="<?= $kat ?>" <?= ($produk['kategori'] == $kat) ? 'selected' : '' ?>><?= $kat ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- Input deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" style="height: 250px;" maxlength="800" id="deskripsi" name="deskripsi" required><?= esc($produk['deskripsi']) ?></textarea>
                </div>

                <!-- Input harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?= number_format($produk['harga'], 0, ',', '.') ?>" required>
                </div>

                <!-- Input stok -->
                <div class="mb-4">
                    <label for="stok" class="form-label fw-semibold">Stok</label>
                    <input type="number" min="0" class="form-control" id="stok" name="stok" value="<?= esc($produk['stok']); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Ubah Produk</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Format input harga dengan titik ribuan
    document.getElementById('harga').addEventListener('input', function () {
        let value = this.value.replace(/\D/g, '');
        this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });

    // Preview multi gambar baru yang diupload
    document.getElementById('semua_gambar').addEventListener('change', function (e) {
        const files = e.target.files;
        const previewContainer = document.getElementById('preview-semua-gambar');
        previewContainer.innerHTML = '';

        Array.from(files).forEach((file, index) => {
            const fileReader = new FileReader();
            fileReader.onload = function (e) {
                const col = document.createElement('div');
                col.classList.add('col-6', 'col-sm-4', 'col-md-3', 'mb-3', 'text-center');
                col.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail rounded" style="height: 150px; object-fit: cover;" alt="Preview Gambar">
                    <small class="text-muted d-block mt-1">${index === 0 ? 'Gambar Utama' : 'Gambar Tambahan'}</small>
                `;
                previewContainer.appendChild(col);
            };
            fileReader.readAsDataURL(file);
        });
    });
</script>

<?= $this->endSection(); ?>