<?= $this->extend('layout/simple'); ?>
<?= $this->section('content'); ?>

<div class="container">

    <?php $errors = session()->getFlashdata('errors'); ?>

    <?php if (! empty($errors)): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?php
    if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success mt-3" role="alert">';
        echo session()->getFlashdata('pesan');
        echo '</div>';
    }
    ?>

    <!-- <div class="row"> -->
    <div class="col-10 mx-auto mt-4">
        <h3 class="py-3">Tambah produk</h3>

        <form action="<?= base_url('simpan_produk') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row mt-3" id="preview-container"></div>

            <div class="mt-3">
                <label for="gambar" class="form-label gambar">Upload Gambar</label>
                <input type="file" class="form-control" accept="image/*" multiple
                    id="gambar" onchange="previewImg()" name="gambar[]" required>
                    <span class="text-muted small">Max size 2Mb, Rasio 1:1 (kotak), File type JPG/JPEG/PNG.</span>
            </div>

            <div class="mt-3">
                <label for="nama_produk" class="form-label">Nama produk</label>
                <input type="text" class="form-control" id="nama_produk" maxlength="50" name="nama_produk" required>
            </div>

            <div class="mt-3">
                <label for="kategori" class="form-label">Kategori</label><br>
                <select class="form-select" aria-label="Default select example" name="kategori" id="kategori" required>
                    <option selected value="">-- Pilih Kategori --</option>
                    <option value="Sofa">Sofa</option>
                    <option value="Kasur">Kasur</option>
                    <option value="Jemuran">Jemuran</option>
                    <option value="Buffet TV">Buffet TV</option>
                    <option value="Buffet Pajangan">Buffet Pajangan</option>
                    <option value="Bantal dan Selimut">Bantal dan Selimut</option>
                    <option value="Dipan Ranjang">Dipan Ranjang</option>
                    <option value="Kursi Bar">Kursi Bar</option>
                    <option value="Kursi Teras">Kursi Teras</option>
                    <option value="Kursi Kantor">Kursi Kantor</option>
                    <option value="Meja Rias">Meja Rias</option>
                    <option value="Meja Belajar">Meja Belajar</option>
                    <option value="Meja Kantor">Meja Kantor</option>
                    <option value="Meja Makan">Meja Makan</option>
                    <option value="Rak Buku">Rak Buku</option>
                    <option value="Rak Piring">Rak Piring</option>
                    <option value="Rak Sepatu">Rak Sepatu</option>
                    <option value="Lemari Arsip">Lemari Arsip</option>
                    <option value="Lemari Pakaian">Lemari Pakaian</option>
                </select>
            </div>

            <div class="mt-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" maxlength="800" id="deskripsi" name="deskripsi" style="height: 250px;"></textarea>
            </div>

            <div class="mt-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" min="1" class="form-control" id="harga" name="harga">
            </div>

            <div class="mt-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" min="1" class="form-control" id="stok_brg" name="stok">
            </div>

            <button type="submit" class="btn btn-primary mt-3 mb-5">Tambah</button>

        </form>

    </div>
    <!-- </div> -->
</div>

<script>
    // Timer alert validasi
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);

    // Preview gambar
    function previewImg() {
        const gambarInput = document.getElementById('gambar');
        const previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = ''; // Hapus preview sebelumnya

        const files = gambarInput.files;
        if (files.length === 0) return;

        for (let i = 0; i < files.length; i++) {
            const fileReader = new FileReader();

            fileReader.onload = function(e) {
                const col = document.createElement('div');
                col.classList.add('col-3', 'mb-3');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail');
                img.style.height = '150px';
                img.style.objectFit = 'cover';

                col.appendChild(img);
                previewContainer.appendChild(col);
            }

            fileReader.readAsDataURL(files[i]);
        }
    }
</script>

<script>
    // Input nominal harga
    document.getElementById('harga').addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, ''); // Hapus semua non digit
        this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Tambahkan titik pemisah ribuan
    })
</script>

<?= $this->endSection(); ?>