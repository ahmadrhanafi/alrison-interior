<?= $this->extend('layout/statis'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="container py-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">Pusat Panggilan</h3>
        <p class="text-muted">Kami siap membantu Anda kapan saja. Hubungi kami melalui saluran berikut:</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="fas fa-phone fa-3x text-success mb-3"></i>
                    <h5 class="fw-semibold">Telepon</h5>
                    <p class="text-muted">Hubungi kami di jam kerja:</p>
                    <h6 class="text-success">(+62) 812-3456-7890</h6>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="fas fa-envelope fa-3x text-danger mb-3"></i>
                    <h5 class="fw-semibold">Email</h5>
                    <p class="text-muted">Kirim pertanyaan atau keluhan Anda:</p>
                    <h6 class="text-danger">cs@alrisoninterior.com</h6>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="fab fa-whatsapp fa-3x text-success mb-3"></i>
                    <h5 class="fw-semibold">WhatsApp</h5>
                    <p class="text-muted">Chat langsung dengan tim kami:</p>
                    <a href="https://wa.me/6281234567890" class="btn btn-success btn-sm rounded-pill px-4">
                        Chat Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <h5 class="fw-semibold">Jam Operasional</h5>
        <p class="text-muted">Senin - Jumat: 08.00 - 17.00 WIB <br> Sabtu: 08.00 - 14.00 WIB</p>
    </div>
</div>

<?= $this->endSection(); ?>