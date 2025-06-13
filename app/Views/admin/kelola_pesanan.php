<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    @media print {

        .btn,
        .btn-sm,
        .navbar-nav,
        .sidebar,
        #accordionSidebar,
        .sidebar-brand,
        .sidebar-divider,
        .sidebar-heading,
        #sidebarToggle,
        .page-link,
        input,
        th:nth-child(7),
        td:nth-child(7),
        a#debug-icon-link,
        footer {
            display: none !important;
        }
    }
</style>

<div class="container mt-4">

    <h5 class="mt-1 mb-3" style="font-weight: 800; color: #333333;">
        Pesanan Konsumen Website
    </h5>

    <div class="d-block d-md-none mb-3">
        <form action="" class="form-inline my-md-0" method="get">
            <div class="input-group">
                <input type="text" name="keyword" style="width: 180px;" class="form-control-sm bg-light border-1 small"
                placeholder="Cari pesanan..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between">
        <form action="" class="d-none d-sm-inline-block form-inline my-md-0" method="get">
            <div class="input-group">
                <input type="text" name="keyword" style="width: 260px;" class="form-control-sm bg-light border-1 small"
                placeholder="Cari pemesan, status, kode pesanan..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <button onclick="print()" class="btn btn-primary btn-sm mb-2">
            <i class="fas fa-print fa-sm text-white-50"></i>&ensp;Cetak PDF
        </button>
    </div>

    <?php if (session()->getFlashdata('sukses')): ?>
        <div class="alert alert-success mt-3"><?= session()->getFlashdata('sukses') ?></div>
    <?php endif; ?>

    <!-- Tambahin table-responsive disini -->
    <div class="table-responsive">
        <table class="table table-bordered mt-2" style="font-size: small;">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kode Pesanan</th>
                    <th>Pemesan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Ubah Status</th>
                </tr>
            </thead>
            <tbody style="color: #333333;">
                <?php $no = 1 + (8 * ($currentPage - 1)); foreach ($pesanan as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($p['created_at'])) ?></td>
                        <td><?= $p['kode_pesanan'] ?></td>
                        <td><?= $p['nama_pemesan'] ?></td>
                        <td>Rp<?= number_format($p['total_harga'], 0, ',', '.') ?></td>

                        <?php
                        $warna = 'bg-secondary';
                        if ($p['status'] == 'Menunggu Pembayaran') $warna = 'bg-warning';
                        elseif ($p['status'] == 'Diproses') $warna = 'bg-info';
                        elseif ($p['status'] == 'Dikirim') $warna = 'bg-primary';
                        elseif ($p['status'] == 'Selesai') $warna = 'bg-success';
                        elseif ($p['status'] == 'Dibatalkan') $warna = 'bg-danger';
                        ?>

                        <td><span class="badge <?= $warna ?>" style="color: #333333;"><?= $p['status']; ?></span></td>
                        <td>
                            <form action="<?= base_url('admin/updateStatus/' . $p['id_pesanan']) ?>" method="post">
                                <select name="status" class="form-select form-select-sm" aria-label="Default select example">
                                    <option <?= $p['status'] == 'Menunggu Pembayaran' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                                    <option <?= $p['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                    <option <?= $p['status'] == 'Dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                    <option <?= $p['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                    <option <?= $p['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                </select>
                                <button type="submit" class="btn btn-success btn-sm mt-2 mr-2">Simpan</button>
                                <a href="<?= base_url('admin/detail-pesanan/' . $p['id_pesanan']) ?>" class="btn btn-primary btn-sm mt-2 mr-2">Detail</a>
                                <a href="<?= base_url('admin/kelola-pesanan/hapus/' . $p['id_pesanan']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')" class="btn btn-danger btn-sm mt-2">Hapus</a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?= $pager->links('pesanan', 'produk_pagination') ?>
</div>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<?= $this->endSection() ?>