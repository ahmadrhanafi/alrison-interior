<?= $this->extend('layout/simple'); ?>
<?= $this->section('content'); ?>

<!-- Cropper -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

<style>
    body {
        padding-top: 80px;
    }

    @media screen {

        a#debug-icon-link,
        #debug-icon {
            display: none;
        }
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="mb-4" style="font-size: large; font-weight: 800; color: #333333;">Profil Saya</h2>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('profil-saya/update') ?>" method="post" enctype="multipart/form-data" style="color: #333333;">
        <?= csrf_field(); ?>

        <?php
        $fotoProfile = session()->get('gambar_user') && session()->get('gambar_user') != ''
            ? session()->get('gambar_user')
            : 'default.jpeg';
        ?>

        <!-- Foto Profil -->
        <div class="text-center mb-4">
            <img src="<?= base_url('profile/' . $fotoProfile); ?>" alt="Foto Profil"
                class="img-thumbnail rounded-circle shadow-sm mb-3" id="profile-picture"
                style="width: 150px; height: 150px; object-fit: cover;">
            <div class="mt-2">
                <label for="gambar_user" class="btn btn-sm btn-outline-primary">Ganti Foto Profil</label>
                <input type="file" class="form-control d-none" id="gambar_user" name="gambar_user" accept="image/*">
            </div>
        </div>

        <!-- Input File -->
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_user" class="form-control" value="<?= $user['nama_user']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Panggilan</label>
            <input type="text" class="form-control form-control-user" id="username"
                placeholder="Nama Panggilan" name="username" value="<?= $user['username']; ?>"
                oninput="formatUsername(this)" autocomplete="off">
        </div>
        <div class="mb-3">
            <label>Alamat Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Nomor Handphone</label>
            <input type="text" name="no_hp" class="form-control" value="<?= $user['no_hp']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" placeholder="Alamat kamu masih kosong nih!" value="<?= $user['alamat']; ?>" class="form-control" rows="3" required><?= session()->get('alamat') ?></textarea>
        </div>

        <div class="d-flex justify-content-end">
            <!-- Hidden input buat hasil crop -->
            <input type="hidden" name="cropped_image_data" id="cropped_image_data">
            <button type="submit" class="btn btn-sm text-white" style="background-color: rgb(0, 80, 200);">Simpan</button>
        </div>
    </form>
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
                <button type="button" id="cropButton" class="btn btn-sm btn-primary">Potong</button>
            </div>
        </div>
    </div>
</div>


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

<?= $this->endSection(); ?>