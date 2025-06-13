<?= $this->extend('layout/dashboard'); ?>
<?= $this->section('content'); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Icon Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background-color: aliceblue;
    }

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
        th:nth-child(5),
        th:nth-child(6),
        td:nth-child(5),
        td:nth-child(6),
        a#debug-icon-link,
        footer {
            display: none !important;
        }
    }
</style>

<div class="container-fluid">

    <h5 class="mt-1 mb-3" style="font-weight: 600; color: #333333;">
        Daftar Konsumen Website
    </h5>

    <div class="d-flex justify-content-between">
        <form action="" class="d-sm-inline-block form-inline my-md-0" method="get">
            <div class="input-group">
                <input type="text" name="keyword" style="width: 180px;" class="form-control-sm bg-light border-1 small"
                    placeholder="Cari konsumen..." autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="d-none d-md-block">
            <button onclick="print()" class="btn btn-primary btn-sm">
                <i class="fas fa-print fa-sm text-white-50"></i>&ensp;Cetak PDF
            </button>
        </div>
    </div>

    <div class="d-block d-md-none">
        <button onclick="print()" class="btn btn-primary btn-sm mt-3">
            <i class="fas fa-print fa-sm text-white-50"></i>&ensp;Cetak PDF
        </button>
    </div>

    <div class="table-responsive-sm mt-3">

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <table class="table table-hover">
            <thead class="table-dark" style="font-size: small;">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Kontak</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aktivitas</th>
                    <th scope="col">Terakhir</th>
                </tr>
            </thead>

            <tbody style="font-size: small; color: #333333;">
                <?php $no = 1 + (10 * ($currentPage - 1));
                foreach ($konsumen as $k) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?php if ($k['gambar_user']) : ?>
                                <img src="<?= base_url('profile/' . $k['gambar_user']) ?>" width="50" height="50" class="rounded-circle">
                            <?php else : ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($k['nama_user']) ?></td>
                        <td><?= esc($k['username']) ?></td>
                        <td><?= esc($k['email']) ?></td>
                        <td><?= esc($k['no_hp']) ?></td>
                        <td><?= esc($k['alamat']) ?></td>
                        <td>
                            <?php
                            $lastActivity = strtotime($k['last_activity']);
                            $now = time();
                            $diff = $now - $lastActivity;

                            if ($diff <= 300) { // 300 detik = 5 menit
                                echo '<span class="badge bg-success">Online</span>';
                            } else {
                                echo '<span class="badge bg-secondary">Offline</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?= timeAgo($k['last_activity']); ?>
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