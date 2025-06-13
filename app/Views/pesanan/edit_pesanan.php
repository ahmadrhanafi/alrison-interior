<?= $this->extend('layout/simple'); ?>

<?= $this->section('content'); ?>

<style>
    @media screen {

        a#debug-icon-link,
        #debug-icon {
            display: none;
        }
    }
</style>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mt-3">
        <h5 class="title rounded p-2 mb-2" style="font-weight: 800; color: #333333;">Kelola Pesanan</h5>
    </div>

    <div class="row">
        <div class="col">
            <div class="card border-2 rounded-2 mb-3 mt-3 mx-auto" style="max-width: 1260px;">
                <div class="row g-0">

                    <div class="col-md-4">
                        <img src="<?= base_url() ?>uploads/<?= $produk['gambar']; ?>" class="img-fluid rounded" style="width: 250px;" alt="<?= $produk['gambar']; ?>">
                    </div>

                    <div class="col-md-8">
                        <div class="card-body mx-2">
                            <p class="card-text" style="font-size: small;"><?= $produk['kategori']; ?></p>
                            <h5 class="card-title" style="font-size: x-large;"><?= $produk['nama_produk']; ?></h5>
                            <h5 class="card-text" style="font-size: large;">Rp<?= number_format($produk['harga'], 0, ',', '.') ?></h5><br>
                            <p class="card-text" style="font-size: small;">Stok : <?= $produk['stok']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="<?= base_url('pesanan/update/' . $pesanan['id_pesanan']); ?>" method="post">
        <input type="hidden" class="form-control" id="id_produk" name="id_produk" value="<?= $produk['id_produk'] ?>">
        <input type="hidden" class="form-control" id="slug" name="slug" value="">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <div class="input-group" style="max-width: 140px;">
                <button type="button" class="btn btn-outline-secondary px-3" id="btn-minus"><i class="fas fa-minus" style="font-size: small;"></i></button>
                <input
                    type="text"
                    class="form-control text-center"
                    id="jumlah"
                    name="jumlah"
                    value="<?= $detailPesanan['jumlah']; ?>"
                    style="max-width: 60px;"
                    disabled>
                <button type="button" class="btn btn-outline-secondary px-3" id="btn-plus"><i class="fas fa-plus" style="font-size: small;"></i></button>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" autocomplete="off" class="form-control" id="nama_pemesan" name="nama_pemesan" value="<?= $pesanan['nama_pemesan']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor Handphone</label>
            <input type="number" min="1" autocomplete="off" class="form-control" id="no_hp" name="no_hp" value="<?= $pesanan['no_hp']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
            <input type="text" class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" value="<?= $pesanan['alamat_pengiriman']; ?>" required>
        </div>

        <div class="d-flex justify-content-end mb-5">
            <a href="<?= base_url('pesanan'); ?>" class="btn btn-danger" id="">Kembali</a>&nbsp;&nbsp;
            <button type="submit" class="btn btn-success">Simpan</button>
            <!-- <button class="btn btn-success" id="pay-button">Buat Pesanan</button> -->
        </div>

    </form>
</div>

<script>
    document.getElementById('harga').addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, ''); // Hapus semua non digit
        this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Tambahkan titik pemisah ribuan
    })
</script>

<?= $this->endSection(); ?>