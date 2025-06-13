<?= $this->extend('layout/simple'); ?>
<?= $this->section('content'); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Icon Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background-color: aliceblue;
    }
</style>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">
        <div class="col-xl-6">

            <div class="card o-hidden border-0 shadow-lg">

                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h5 class="fw-bold" style="color: #333333;">Silahkan Masuk!</h5>
                            </div>

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
                            if (session()->getFlashdata('sukses')) {
                                echo '<div class="alert alert-success mt-3" role="alert">';
                                echo session()->getFlashdata('sukses');
                                echo '</div>';
                            }
                            if (session()->getFlashdata('gagal')) {
                                echo '<div class="alert alert-danger mt-3" role="alert">';
                                echo session()->getFlashdata('gagal');
                                echo '</div>';
                            }
                            ?>

                            <?php echo form_open('auth/cek_login'); ?>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                    id="email" aria-describedby="emailHelp"
                                    placeholder="Email" name="email">
                            </div>
                            <div class="form-group position-relative">
                                <input type="password" class="form-control form-control-user"
                                    id="password" placeholder="Password" name="password">
                                <!-- <i class="fas fa-eye-slash position-absolute top-50 end-0 translate-middle-y me-4"
                                        style="cursor: pointer;"
                                        onclick="togglePassword('password', this)"></i> -->
                            </div>
                            <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div>
                                </div> -->
                            <button type="submit" class="btn btn-user btn-block text-white mt-3" style="background-color: rgb(0, 80, 200);">
                                Login
                            </button>
                            <?php echo form_close(); ?>

                            <hr>
                            <div class="text-center">
                                <a class="small text-decoration-none" href="<?= base_url('forgot-password'); ?>">Lupa password</a>
                            </div>
                            <div class="text-center" style="color: #333333;">
                                <small>Belum punya akun?</small><a class="small text-decoration-none" href="register"> Daftar!</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // tutup alert
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);

    // password
    function togglePassword(id, el) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            el.classList.remove('fa-eye-slash');
            el.classList.add('fa-eye');
        } else {
            input.type = "password";
            el.classList.remove('fa-eye');
            el.classList.add('fa-eye-slash');
        }
    }
</script>


<?= $this->endSection(); ?>