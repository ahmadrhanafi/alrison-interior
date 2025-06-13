<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Ganti Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() ?>/main-icon.png" type="image/x-icon">
</head>

<style>
    body {
        background-color: aliceblue;
    }

    @media screen {

        a#debug-icon-link,
        #debug-icon {
            display: none;
        }
    }
</style>

<body>

    <div class="container py-5">

        <div class="mb-4 text-center">
            <h5 style="font-size: x-large; font-weight: 800; color: #333333;">Ganti Password</h5>
        </div>

        <div class="card shadow p-5">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('change-password') ?>">
                <div class="mb-3">
                    <label>Password Lama</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm text-white" style="background-color: rgb(0, 80, 200);">Ubah Password</button>
                </div>
            </form>
        </div>

    </div>

    <!-- footer -->
    <div class="fixed-sm-bottom mt-5 d-flex justify-content-center mx-auto mt-5">
        <div class="copyright text-center form-control-sm">
            <small><span>Copyright &copy; 2025 <b>Alrison Interior.</b> All Rights Reserved</span></small>
        </div>
    </div>

</body>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</html>