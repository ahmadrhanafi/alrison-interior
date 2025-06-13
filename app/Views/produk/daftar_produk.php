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
        input,
        th:nth-child(7),
        th:nth-child(8),
        th:nth-child(9),
        td:nth-child(7),
        td:nth-child(8),
        td:nth-child(9),
        a#debug-icon-link,
        footer {
            display: none !important;
        }
    }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between">
        <h5 class="mt-1 mb-3" style="font-weight: 600; color: #333333;">
            Daftar Produk
        </h5>

        <div class="d-none d-md-block">
            <a href="<?= base_url('tambah-produk'); ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus-circle" style="font-size: x-small;"></i>&ensp;Produk</a>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <form action="" class="d-sm-inline-block form-inline my-md-0" method="get">
            <div class="input-group">
                <input type="text" name="keyword" style="width: 150px;" class="form-control-sm bg-light border-1 small" placeholder="Cari produk..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="d-none d-md-block">
            <button onclick="print()" class="btn btn-primary btn-sm" style="padding-left: 8px;">
                <i class="fas fa-print fa-sm text-white-50"></i>&ensp;Cetak&ensp;
            </button>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-3">
        <div class="d-block d-md-none">
            <a href="<?= base_url('tambah-produk'); ?>" class="btn btn-primary btn-sm mr-2">
                <i class="fas fa-plus-circle" style="font-size: x-small;"></i>
                &ensp;Produk
            </a>

            <button onclick="print()" class="btn btn-primary btn-sm" style="padding-left: 8px;">
                <i class="fas fa-print fa-sm text-white-50"></i>&ensp;Cetak&ensp;
            </button>
        </div>
    </div>

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
                    <th scope="col" style="font-size: small;">Gambar</th>
                    <th scope="col" style="font-size: small;">Produk</th>
                    <th scope="col" style="font-size: small;">Kategori</th>
                    <th scope="col" style="font-size: small;">Harga</th>
                    <th scope="col" style="font-size: small;">Stok</th>
                    <th scope="col"></th>
                    <th scope="colspan=3" style="font-size: small;">Aksi</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <?php
            $no = 1 + (8 * ($currentPage - 1));
            foreach ($produk as $p) : ?>

                <tbody style="color: #333333;">
                    <tr>
                        <td><small><?= $no++; ?></small></td>
                        <td>
                            <div class="d-flex flex-column align-items-start">
                                <img src="<?= base_url(); ?>/uploads/<?= $p['gambar']; ?>" class="rounded mb-1" width="80px" height="80px" alt="<?= $p['gambar']; ?>">
                            </div>
                        </td>
                        <td><small><?= $p['nama_produk']; ?></small></td>
                        <td><small><?= $p['kategori']; ?></small></td>
                        <td><small>Rp<?= number_format($p['harga'], 0, ',', '.') ?></small></td>
                        <td><small><?= $p['stok']; ?></small></td>
                        <td>
                            <form action="<?= base_url() ?>produk/<?= $p['slug']; ?>" method="get" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-info-circle fa-sm"></i></button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= base_url() ?>edit-produk/<?= $p['id_produk']; ?>" method="get" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method">
                                <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-sm"></i></button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= base_url() ?>produk/<?= $p['id_produk']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')"><i class="fas fa-trash fa-sm"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>

            <?php endforeach; ?>
        </table>
        <small><?= $pager->links('produk', 'produk_pagination'); ?></small>
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