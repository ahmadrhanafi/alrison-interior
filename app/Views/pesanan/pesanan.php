<?= $this->extend('layout/statis'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: aliceblue;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between">
        <h5 class="mb-2" style="font-size: large; font-weight: 800; color: #333333;">Riwayat Pesanan</h5>

        <a href="<?= base_url('toko'); ?>" style="text-decoration: none; font-size: small;">
            <i class="fas fa-arrow-circle-left" style="font-size: small;"></i>&nbsp;Kembali ke Beranda
        </a>
    </div>

    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('sukses'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('gagal')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('gagal'); ?>
        </div>
    <?php endif; ?>

    <?php if ($success) : ?>
        <div class="alert alert-success">Pembayaran berhasil dan Pesananmu akan segera diproses!</div>
    <?php endif; ?>

    <!-- Wrapper table-responsive -->
    <div class="mt-3">

        <?php if (empty($pesanan)) : ?>
            <div class="p-3 bg-warning bg-opacity-10 border border-warning text-gray-800 rounded mt-4">
                Belum ada pesanan.
            </div>
        <?php else : ?>
            <?php foreach ($pesanan as $p) : ?>
                <?php
                $warna = 'secondary';
                if ($p['status'] == 'Menunggu Pembayaran') $warna = 'warning';
                elseif ($p['status'] == 'Diproses') $warna = 'info';
                elseif ($p['status'] == 'Dikirim') $warna = 'primary';
                elseif ($p['status'] == 'Selesai') $warna = 'success';
                elseif ($p['status'] == 'Dibatalkan') $warna = 'danger';
                ?>

                <div class="card border-1 shadow-sm rounded mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap">
                            <!-- Gambar -->
                            <div class="flex-shrink-0 me-3 mb-3">
                                <img src="<?= base_url('uploads/' . $p['gambar']) ?>" width="120" height="120" class="rounded object-fit-cover" alt="<?= $p['nama_produk']; ?>">
                            </div>

                            <!-- Detail -->
                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-2">
                                    <div>
                                        <!-- Status (di atas nama produk saat mobile) -->
                                        <span class="badge bg-<?= $warna ?> text-dark d-md-none mb-1"><?= $p['status']; ?></span>

                                        <p class="mb-1 text-muted small">#<?= $p['kode_pesanan']; ?></p>
                                        <h6 class="mb-1"><?= $p['nama_produk']; ?></h6>
                                        <p class="mb-1 text-muted small">Tanggal: <?= date('d-m-Y H:i', strtotime($p['created_at'])); ?></p>
                                        <p class="mb-1 text-muted small">Total: <strong>Rp<?= number_format($p['total_harga'], 0, ',', '.') ?></strong></p>
                                    </div>
                                    <!-- Status di kanan atas saat desktop -->
                                    <span class="badge bg-<?= $warna ?> text-dark d-none d-md-block"><?= $p['status']; ?></span>
                                </div>

                                <!-- Tombol aksi di pojok kanan bawah -->
                                <div class="d-flex justify-content-end gap-2">
                                    <?php if (in_array($p['status'], ['Menunggu Pembayaran', 'Dibatalkan'])) : ?>
                                        <a href="<?= base_url('pesanan/hapus/' . $p['id_pesanan']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')"
                                            class="btn btn-sm border btn-danger" style="font-size: small;" title="Hapus Pesanan">
                                            <i class="fa fa-trash mt-1"></i>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('pesanan/detail-pesanan/' . $p['id_pesanan']); ?>" class="btn btn-sm btn-outline-primary">Info</a>
                                    <a href="<?= base_url('pesanan/edit_pesanan' . $p['id_pesanan']); ?>" class="btn btn-sm btn-warning text-white">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!-- end table-responsive -->

    <div class="p-3 bg-danger bg-opacity-10 border border-danger text-gray-800 rounded mt-4 mb-5" style="padding: 25px;">
        <h6 style="font-weight: 600; color: #c80000;">Perhatian!</h6>
        <p>Jika produk yang telah dipesan tidak segera dilakukan pembayaran selama 24jam,<br>maka pesanan tersebut akan dihapus oleh Admin. Terimakasih dan selamat berbelanja!</p>
    </div>

</div>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);
</script>

<?= $this->endSection(); ?>