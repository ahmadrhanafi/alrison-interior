<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Icon Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    @media print {
        table {
            margin-top: 25px;
        }

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
        form,
        input,
        a#debug-icon-link,
        footer {
            display: none !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h5 class="mt-1" style="font-weight: 600; color: #333333;">
            Transaksi Melalui Website
        </h5>
    </div>

    <div class="d-block d-md-none">
        <form action="" class="form-inline my-md-0" method="get">
            <div class="input-group">
                <input type="text" name="keyword" style="width: 180px;" class="form-control-sm bg-light border-1 small"
                placeholder="Cari transaksi..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between mt-2">
        <form action="" class="d-none d-sm-inline-block form-inline my-md-0" method="get">
            <div class="input-group">
                <input type="text" name="keyword" style="width: 300px;" class="form-control-sm bg-light border-1 small"
                    placeholder="Cari nama pemesan, kontak, produk, alamat..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <button onclick="print()" class="btn btn-primary btn-sm mb-4">
            <i class="fas fa-print fa-sm"></i>&ensp;Cetak PDF
        </button>
    </div>

    <!-- <div class="card shadow mb-4">
        <div class="card-body mt-2"> -->
            <div class="table-responsive mt-2">
                <table class="table table-bordered table-hover small" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Pemesan</th>
                            <th>Kontak</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pesananSelesai)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Data transaksi tidak ada.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1 + (10 * ($currentPage - 1));
                            foreach ($pesananSelesai as $p) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($p['created_at'])) ?></td>
                                    <td><?= esc($p['kode_pesanan']) ?></td>
                                    <td><?= esc($p['nama_pemesan']) ?></td>
                                    <td><?= esc($p['no_hp']) ?></td>
                                    <td>
                                        <?php
                                        $detail = $modelDetailPesanan->where('id_pesanan', $p['id_pesanan'])->findAll();
                                        foreach ($detail as $d) {
                                            $produk = $modelProduk->find($d['id_produk']);
                                            echo esc($produk['nama_produk']) . '<br>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($detail as $d) {
                                            echo $d['jumlah'] . '<br>';
                                        }
                                        ?>
                                    </td>
                                    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= esc($p['alamat_pengiriman']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php if ($pager) : ?>
                    <div class="mt-3">
                        <?= $pager->links('transaksi', 'konsumen_pagination'); ?>
                    </div>
                <?php endif; ?>
            </div>
        <!-- </div>
    </div> -->
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection() ?>