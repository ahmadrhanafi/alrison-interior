<?= $this->extend('layout/statis'); ?>

<?= $this->section('content'); ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">Layanan Dukungan</h3>
        <p class="text-muted">Alrison Interior hadir untuk memastikan Anda mendapatkan pengalaman terbaik, mulai dari pemesanan hingga purna jual.</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="p-4 bg-light border rounded-3 shadow-sm text-center h-100">
                <div class="mb-3">
                    <i class="bi bi-headset text-success fs-1"></i>
                </div>
                <h5 class="fw-semibold">Customer Care 24/7</h5>
                <p class="text-muted">Tim kami siap membantu Anda kapan saja untuk pertanyaan atau kendala seputar produk dan layanan.</p>
                <span class="badge bg-success">Respon Cepat</span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="p-4 bg-white border rounded-3 shadow-sm text-center h-100">
                <div class="mb-3">
                    <i class="bi bi-wrench-adjustable-circle text-primary fs-1"></i>
                </div>
                <h5 class="fw-semibold">Layanan Custom Furniture</h5>
                <p class="text-muted">Dapatkan layanan konsultasi desain dan pemesanan furniture custom sesuai kebutuhan interior Anda.</p>
                <span class="badge bg-primary">Sesuai Permintaan</span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="p-4 bg-light border rounded-3 shadow-sm text-center h-100">
                <div class="mb-3">
                    <i class="bi bi-box-seam text-warning fs-1"></i>
                </div>
                <h5 class="fw-semibold">Dukungan Pengiriman Aman</h5>
                <p class="text-muted">Setiap produk dikemas dengan standar aman untuk memastikan barang sampai dalam kondisi sempurna.</p>
                <span class="badge bg-warning text-dark">Pengepakan Aman</span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="p-4 bg-white border rounded-3 shadow-sm text-center h-100">
                <div class="mb-3">
                    <i class="bi bi-shield-check text-info fs-1"></i>
                </div>
                <h5 class="fw-semibold">Garansi Produk</h5>
                <p class="text-muted">Setiap produk furniture Alrison Interior dilindungi garansi resmi sesuai ketentuan yang berlaku.</p>
                <span class="badge bg-info text-white">2 - 3 Bulan</span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="p-4 bg-light border rounded-3 shadow-sm text-center h-100">
                <div class="mb-3">
                    <i class="bi bi-recycle text-success fs-1"></i>
                </div>
                <h5 class="fw-semibold">Pengembalian & Penukaran</h5>
                <p class="text-muted">Kami memberikan kemudahan proses retur dan penukaran barang sesuai prosedur yang telah ditentukan.</p>
                <span class="badge bg-success">Proses Mudah</span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="p-4 bg-white border rounded-3 shadow-sm text-center h-100">
                <div class="mb-3">
                    <i class="bi bi-envelope-paper-fill text-danger fs-1"></i>
                </div>
                <h5 class="fw-semibold">Kontak Layanan</h5>
                <p class="text-muted">Hubungi kami melalui telepon, email, atau WhatsApp untuk dukungan cepat dan informasi seputar produk.</p>
                <a href="mailto:support@alrisoninterior.com" class="btn btn-danger btn-sm mt-2">Kirim Email</a>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>