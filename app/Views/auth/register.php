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

        .tooltip-info {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #f8f9fa;
            padding: 4px 8px;
            border: 1px solid #ccc;
            font-size: 12px;
            border-radius: 4px;
            z-index: 10;
            white-space: nowrap;
            margin-top: 4px;
        }

        .position-relative input:focus+.tooltip-info {
            display: block;
        }

        @media screen {

            a#debug-icon-link,
            #debug-icon {
                display: none;
            }
        }

        @media screen and (max-width: 780px) {
            img.main-logo {
                max-width: 200%;
            }
        }

        @media screen and (max-width: 480px) {
            img.main-logo {
                max-width: 400%;
            }
        }

        .modal-xl .modal-body {
            max-height: 60vh;
            padding: 0;
            overflow: hidden;
        }

        #image-to-crop {
            width: 100%;
            max-height: 60vh;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        @media (max-width: 576px) {
            .modal-xl {
                max-width: 95%;
                margin: auto;
            }

            .modal-xl .modal-body {
                max-height: 75vh;
            }

            #image-to-crop {
                max-height: 75vh;
            }
        }
    </style>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card o-hidden border-0 shadow-lg my-2">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="p-5">

                                    <div class="text-center mb-4">
                                        <h5 class="fw-bold" style="color: #333333;">Silahkan Daftar!</h5>
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
                                    if (session()->getFlashdata('pesan')) {
                                        echo '<div class="alert alert-success mt-3" role="alert">';
                                        echo session()->getFlashdata('pesan');
                                        echo '</div>';
                                    }
                                    ?>

                                    <form action="simpan_register" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nama_user"
                                                placeholder="Nama Lengkap" name="nama_user" value="<?= old('nama_user') ?>">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0 position-relative">
                                                <input type="text" class="form-control form-control-user" id="username"
                                                    placeholder="Nama Panggilan" name="username" value="<?= old('username') ?>"
                                                    oninput="formatUsername(this)" autocomplete="off">
                                                <!-- <small class="text-muted tooltip-info">Huruf pertama kapital, tanpa spasi.</small> -->
                                            </div>

                                            <div class="col-sm-6">
                                                <input type="number" class="form-control form-control-user" id="no_hp"
                                                    placeholder="Nomor Handphone" name="no_hp" value="<?= old('no_hp') ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                placeholder="Alamat Email" name="email" value="<?= old('email') ?>">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0 position-relative">
                                                <input type="password" class="form-control form-control-user" id="password"
                                                    placeholder="Password" name="password">
                                                <i class="fas fa-eye-slash position-absolute top-50 end-0 translate-middle-y me-4"
                                                    style="cursor: pointer;"
                                                    onclick="togglePassword('password', this)"></i>
                                            </div>

                                            <div class="col-sm-6 position-relative">
                                                <input type="password" class="form-control form-control-user" id="repassword"
                                                    placeholder="Konfirmasi Password" name="repassword">
                                                <i class="fas fa-eye-slash position-absolute top-50 end-0 translate-middle-y me-4"
                                                    style="cursor: pointer;"
                                                    onclick="togglePassword('repassword', this)"></i>
                                            </div>
                                        </div>

                                        <input type="hidden" name="cropped_image" id="cropped_image_data">

                                        <button type="submit" class="btn btn-user btn-block text-white" style="background-color: rgb(0, 80, 200);">
                                            Register
                                        </button>
                                    </form>

                                    <hr>

                                    <div class="text-center">
                                        <a class="small text-decoration-none" href="<?= base_url('web'); ?>">Kembali ke Toko</a>
                                    </div>
                                    <div class="text-center" style="color: #333333;">
                                        <small>Sudah punya akun?</small><a class="small text-decoration-none" href="login"> Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Cropper -->
        <div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Potong Foto Profil</h5>
                        <button type="button" class="btn-close" style="margin-top: 0px;" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 100px;">
                        <img id="image-to-crop" class="w-100 rounded shadow" style="max-width: 100%; height: auto;" alt="Image to crop">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cropButton" class="btn btn-primary">Potong</button>
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

        // username
        function formatUsername(input) {
            // ambil value, buang spasi dan karakter selain huruf (a-zA-Z)
            let val = input.value.replace(/[^a-zA-Z]/g, '').toLowerCase();

            // kapital huruf pertama kalau ada isinya
            if (val.length > 0) {
                val = val.charAt(0).toUpperCase() + val.slice(1);
            }

            input.value = val;
        }

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