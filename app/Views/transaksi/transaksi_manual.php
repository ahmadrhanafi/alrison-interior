<?= $this->extend('layout/dashboard'); ?>
<?= $this->section('content'); ?>

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
        th:nth-child(9),
        th:nth-child(10),
        th:nth-child(11),
        td:nth-child(9),
        td:nth-child(10),
        td:nth-child(11),
        a#debug-icon-link,
        footer {
            display: none !important;
        }
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <h5 class="mt-1" style="font-weight: 600; color: #333333;">
            Daftar Transaksi Manual Toko
        </h5>

        <div class="d-none d-md-block">
            <a href="<?= base_url('tambah-transaksi') ?>" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus-circle"></i>&ensp;Transaksi&nbsp;</a>
        </div>
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
                <input type="text" name="keyword" style="width: 300px;" class="form-control-sm bg-light border-1 small" placeholder="Cari nama, kontak, nomor transaksi..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="d-block d-md-none">
            <a href="<?= base_url('tambah-transaksi') ?>" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus-circle"></i>&ensp;Transaksi&nbsp;</a>
        </div>

        <button onclick="print()" class="btn btn-primary btn-sm mb-4">
            <i class="fas fa-print fa-sm text-white-50"></i>&ensp;Cetak PDF
        </button>
    </div>

    <!-- Table -->
    <div class="table-responsive-sm">

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="font-size: small;">No.</th>
                    <th scope="col" style="font-size: small;">Tanggal</th>
                    <th scope="col" style="font-size: small;">Jenis</th>
                    <th scope="col" style="font-size: small;">Nomor</th>
                    <th scope="col" style="font-size: small;">Nama</th>
                    <th scope="col" style="font-size: small;">Status</th>
                    <th scope="col" style="font-size: small;">Keterangan</th>
                    <th scope="col"></th>
                    <th scope="colspan=3" style="font-size: small;">Aksi</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <?php
            $no = 1 + (10 * ($currentPage - 1));
            foreach ($transaksi as $t) : ?>

                <tbody style="color: #333333;">
                    <tr>
                        <td><small><?= $no++; ?></small></td>
                        <td><small><?= $t['created_at']; ?></small></td>
                        <td><small><?= $t['jenis_transaksi']; ?></small></td>
                        <td><small><?= $t['kode_transaksi']; ?></small></td>
                        <td><small><?= $t['nama']; ?></small></td>

                        <?php
                        $warna = 'bg-secondary';
                        if ($t['status'] == 'Tempo') $warna = 'bg-warning';
                        elseif ($t['status'] == 'Kredit') $warna = 'bg-info';
                        elseif ($t['status'] == 'Selesai') $warna = 'bg-success';
                        ?>

                        <td><small><span class="badge <?= $warna ?>" style="color: #333333;"><?= $t['status']; ?></span></small></td>
                        <td><small><?= $t['keterangan']; ?></small></td>

                        <td>
                            <form action="detail_transaksi/<?= $t['id_transaksi']; ?>" method="get" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-info-circle fa-sm"></i></button>
                            </form>
                        </td>
                        <td>
                            <form action="edit_transaksi/<?= $t['id_transaksi']; ?>" method="get" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method">
                                <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-sm"></i></button>
                            </form>
                        </td>
                        <td>
                            <form action="transaksi/<?= $t['id_transaksi']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')"><i class="fas fa-trash fa-sm"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
        <small><?= $pager->links('transaksi', 'konsumen_pagination'); ?></small>


        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(300, 0).slideUp(300, function() {
                    $(this).remove();
                });
            }, 3000);
        </script>

        <?= $this->endSection(); ?>