<?= $this->extend('layout/statis'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    body {
        background-color: aliceblue;
    }
</style>

<div class="container my-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">Komunitas Alrison Interior</h3>
        <p class="text-muted">Tempat berkumpulnya para pecinta desain interior & pelanggan setia kami. Yuk, berbagi inspirasi, tips, dan pengalaman di sini!</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-3 text-success"></i>
                    <h5 class="fw-semibold">Forum Diskusi</h5>
                    <p class="text-muted">Bergabung dan diskusikan berbagai topik seputar desain rumah, tips perawatan furniture, hingga rekomendasi produk.</p>
                    <!-- <div class="mt-2 mb-3">
                        <a href="#" class="btn btn-outline-success btn-sm rounded-pill">Gabung Forum</a>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-camera-retro fa-3x mb-3 text-success"></i>
                    <h5 class="fw-semibold">Galeri Pelanggan</h5>
                    <p class="text-muted">Bagikan foto-foto hasil desain rumah atau ruangan favorit kamu menggunakan produk dari Alrison Interior!</p>
                    <!-- <div class="mt-2 mb-3">
                        <a href="#" class="btn btn-outline-success btn-sm rounded-pill">Lihat Galeri</a>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-lightbulb fa-3x mb-3 text-success"></i>
                    <h5 class="fw-semibold">Tips & Inspirasi</h5>
                    <p class="text-muted">Dapatkan berbagai tips menarik seputar desain interior dan inspirasi furniture untuk mempercantik rumah Anda.</p>
                    <!-- <div class="mt-2 mb-3">
                        <a href="#" class="btn btn-outline-success btn-sm rounded-pill">Baca Tips</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <h4 class="fw-semibold mb-3">Bergabung di Komunitas Kami</h4>
        <p class="text-muted mb-4">Ayo jadi bagian dari keluarga Alrison Interior dan dapatkan berbagai manfaat menarik lainnya!</p>
        <a href="https://api.whatsapp.com/send/?phone=%2B6289526336995" class="btn btn-success rounded-pill px-4">Daftar Sekarang</a>
    </div>
</div>


<?= $this->endSection(); ?>