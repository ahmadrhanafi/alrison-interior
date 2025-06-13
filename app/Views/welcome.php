<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() ?>/main-icon.png" type="image/x-icon">

    <!-- Cropper -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

</head>

<style>
    body {
        background-color: aliceblue;
        padding-top: 80px;
    }

    @media screen {

        a#debug-icon-link,
        #debug-icon {
            display: none;
        }
    }
</style>

<body>
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light topbar fixed-top shadow" style="height: 80px; background-color:rgb(0, 80, 200);">

        <!-- Topbar - Brand -->

        <a class="topbar-brand" style="max-width: 10%;" href="<?= base_url('toko'); ?>">
            <img src="<?= base_url() ?>/main-logo.png" class="main-logo mb-1" style="width: 150px; position: static;" alt="Alrison Interior">
        </a>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <?php
                $fotoProfile = session()->get('gambar_user') && session()->get('gambar_user') != ''
                    ? session()->get('gambar_user')
                    : 'default.jpeg';
                ?>

                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle"
                        src="<?= base_url('profile/' . $fotoProfile); ?>">
                </a>

                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= base_url('profil-saya'); ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= session()->get('nama_user'); ?>
                    </a>
                    <a class="dropdown-item" href="<?= base_url('pesanan'); ?>">
                        <i class="fas fa-truck fa-sm fa-fw mr-2 text-gray-400"></i>
                        Pesanan Saya
                    </a>
                    <a class="dropdown-item" href="<?= base_url('change-password'); ?>">
                        <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ganti Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logout" style="color: #333333;">Anda yakin ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Logout untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-sm text-white mr-2" style="background-color: #333333;" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-sm text-white" style="background-color: #c80000;" href="<?= base_url('auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="container d-flex justify-content-center mt-5 mb-5">
        <div class="card shadow p-5">
            <h2 class="text-center" style="font-size: large; font-weight: 800; color: #333333;">Selamat datang, <?= session()->get('username'); ?></h2>
            <small class="text-muted text-center mb-4">Selamat berbelanja di Alrison Interior!</small>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('simpan-foto') ?>" method="post" enctype="multipart/form-data" style="color: #333333;">
                <?= csrf_field(); ?>

                <!-- Preview Image -->
                <div class="d-flex justify-content-center">
                    <img src="<?= base_url(); ?>profile/default.jpeg" class="img-thumbnail img-preview rounded-circle mb-3" width="150" height="150" id="profile-picture">
                </div>

                <!-- Input File -->
                <div class="form-group mb-3">
                    <label for="gambar_user" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" id="gambar_user" name="gambar_user" accept="image/*">
                </div>

                <div class="d-flex justify-content-end">
                    <!-- Hidden input buat hasil crop -->
                    <input type="hidden" name="cropped_image_data" id="cropped_image_data">
                    <a href="<?= base_url('toko'); ?>" class="btn btn-sm btn-secondary text-white mr-2">Lewati</a>
                    <button type="submit" class="btn btn-sm text-white" style="background-color: rgb(0, 80, 200);">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Cropper -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Potong Foto Profil</h5>
                    <button type="button" class="btn-close" style="margin-top: 0px;" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <!-- Footer -->
    <footer class="fixed-sm-bottom mt-5 mb-5">
        <div class="container my-auto form-control-sm">
            <div class="copyright text-center my-auto">
                <small><span>Copyright &copy; 2025 <b>Alrison Interior.</b> All Rights Reserved</span></small>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Cropper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // tutup alert
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 300);
            });
        }, 3000);

        // cropperJS
        let cropper;
        const inputFile = document.getElementById('gambar_user');
        const imageToCrop = document.getElementById('image-to-crop');
        const profilePicture = document.getElementById('profile-picture');
        const cropButton = document.getElementById('cropButton');
        const croppedImageData = document.getElementById('cropped_image_data');
        const cropperModalEl = document.getElementById('cropperModal');
        const cropperModal = new bootstrap.Modal(cropperModalEl);

        inputFile.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imageToCrop.src = event.target.result;
                    cropperModal.show();

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 1,
                        viewMode: 1,
                        responsive: true,
                        autoCropArea: 1,
                        background: false,
                        movable: true,
                        zoomable: true,
                        scalable: true,
                        cropBoxResizable: true,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        cropButton.addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });

            profilePicture.src = canvas.toDataURL();
            croppedImageData.value = canvas.toDataURL();

            cropperModal.hide();
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url() ?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url() ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url() ?>/js/demo/chart-pie-demo.js"></script>

</body>

</html>