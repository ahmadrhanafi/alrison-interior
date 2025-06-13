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
        <h3 class="fw-bold">Bantuan & Dukungan</h3>
        <p class="text-muted">Kami hadir untuk membantu Anda! Temukan solusi atas pertanyaan umum atau hubungi tim kami kapan saja.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-question-circle fa-3x text-success mb-3"></i>
                    <h5 class="card-title fw-semibold">FAQ (Pertanyaan Umum)</h5>
                    <p class="card-text text-muted">Temukan jawaban atas pertanyaan yang sering diajukan pelanggan seputar pemesanan, pembayaran, dan layanan kami.</p>
                    <a href="<?= base_url('faqs') ?>" class="btn btn-outline-success btn-sm">Lihat FAQ</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-headset fa-3x text-success mb-3"></i>
                    <h5 class="card-title fw-semibold">Pusat Bantuan</h5>
                    <p class="card-text text-muted">Butuh bantuan lebih lanjut? Hubungi tim customer service kami yang siap membantu Anda setiap hari.</p>
                    <a href="<?= base_url('kontak') ?>" class="btn btn-outline-success btn-sm">Hubungi Kami</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-box-open fa-3x text-success mb-3"></i>
                    <h5 class="card-title fw-semibold">Pelacakan Pesanan</h5>
                    <p class="card-text text-muted">Lacak status dan progres pesanan Anda dengan mudah melalui fitur pelacakan pesanan kami.</p>
                    <a href="<?= base_url('cek-pesanan') ?>" class="btn btn-outline-success btn-sm">Cek Pesanan</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <h5 class="fw-semibold mb-3">Masih Butuh Bantuan?</h5>
        <p class="text-muted">Jangan ragu untuk menghubungi kami melalui kontak berikut:</p>
        <p><i class="fas fa-envelope text-success me-2"></i>cs@alrisoninterior.com</p>
        <p><i class="fas fa-phone text-success me-2"></i>+62 812-3456-7890</p>
        <p><i class="fas fa-map-marker-alt text-success me-2"></i>Jl. Melati No. 88, Jakarta</p>
    </div>
</div>

<?= $this->endSection(); ?>