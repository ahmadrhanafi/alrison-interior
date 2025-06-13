<?= $this->extend('layout/dashboard'); ?>
<?= $this->section('content'); ?>

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
        form,
        input,
        th:nth-child(6),
        td:nth-child(6),
        a#debug-icon-link,
        footer {
            display: none !important;
        }
    }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between">
        <h5 class="mb-3" style="font-weight: 600; color: #333333;">
            Daftar Konsumen Toko
        </h5>

        <div class="d-none d-md-block">
            <a href="<?= base_url('tambah-konsumen'); ?>" class="btn btn-primary btn-sm mb-3">
                <i class="fas fa-plus-circle" style="font-size: small;"></i>
                &ensp;Konsumen
            </a>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <form action="" class="d-sm-inline-block form-inline my-md-0 mb-3" method="get">
            <div class="input-group">
                <input type="text" name="keyword" style="width: 180px;" class="form-control-sm bg-light border-1 small" placeholder="Cari konsumen..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="d-none d-md-block">
            <button onclick="print()" class="btn btn-primary btn-sm mb-1">
                <i class="fas fa-print fa-sm text-white-50" style="padding-left: 6px;"></i>&ensp;Cetak PDF
            </button>
        </div>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <div class="d-block d-md-none">
            <a href="<?= base_url('tambah-konsumen'); ?>" class="btn btn-primary btn-sm mr-2">
                <i class="fas fa-plus-circle" style="font-size: small;"></i>
                &ensp;Konsumen
            </a>

            <button onclick="print()" class="btn btn-primary btn-sm" style="padding-left: 8px;">
                <i class="fas fa-print fa-sm text-white-50"></i>
                &ensp;Cetak PDF
            </button>
        </div>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive-sm">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="font-size: small;">No.</th>
                    <th scope="col" style="font-size: small;">Tanggal</th>
                    <th scope="col" style="font-size: small;">Nama</th>
                    <th scope="col" style="font-size: small;">Kontak</th>
                    <th scope="col" style="font-size: small;">Alamat</th>
                    <th scope="col" colspan="2" style="font-size: small;">Aksi</th>
                </tr>
            </thead>
            <tbody style="color: #333333;">
                <?php
                $no = 1 + (10 * ($currentPage - 1));
                foreach ($konsumen as $k) : ?>
                    <tr>
                        <td><small><?= $no++; ?></small></td>
                        <td><small><?= $k['created_at']; ?></small></td>
                        <td><small><?= $k['nama_konsumen']; ?></small></td>
                        <td><small><?= $k['no_hp']; ?></small></td>
                        <td><small><?= $k['alamat']; ?></small></td>
                        <td>
                            <form action="<?= base_url('edit-konsumen/' . $k['id_konsumen']) ?>" method="get" class="d-inline">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit fa-sm"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= base_url('konsumen/' . $k['id_konsumen']) ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')">
                                    <i class="fas fa-trash fa-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <small><?= $pager->links('konsumen', 'konsumen_pagination'); ?></small>
    </div>
</div>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<?= $this->endSection(); ?>