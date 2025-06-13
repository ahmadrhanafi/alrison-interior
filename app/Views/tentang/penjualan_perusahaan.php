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
        <h3 class="fw-bold">Penjualan Perusahaan</h1>
        <p class="text-muted">Solusi furnishing untuk kantor, hotel, apartemen, restoran, dan proyek interior skala besar. <br> Dapatkan produk berkualitas dengan layanan terbaik dari Alrison Interior.</p>
    </div>

    <div class="row g-4 d-flex justify-content-center">
        <!-- <div class="col-md-6">
            <img src="https://via.placeholder.com/600x400" class="img-fluid rounded-4 shadow" alt="Penjualan Perusahaan">
        </div> -->
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h4 class="fw-semibold text-center mb-3">Layanan Khusus Corporate & Project Interior</h4>
            <p class="text-muted text-center mb-4">Kami menyediakan berbagai produk custom furniture dan interior premium untuk kebutuhan perusahaan dan proyek komersial. Mulai dari office set, hotel furniture, hingga café & restaurant interior.</p>
            <div class="card p-3">
                <h5 class="text-center">Benefits</h5>
                <ul class="list-unstyled text-muted small mt-3">
                    <li><i class="fas fa-check-circle text-success me-2"></i> Harga khusus corporate & bulk order</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Custom desain & material sesuai kebutuhan proyek</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Layanan pengiriman & instalasi ke lokasi</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Konsultasi gratis dengan desainer interior profesional</li>
                </ul>
            </div>
            <!-- <a href="#form-penawaran" class="btn btn-success rounded-pill px-4">Ajukan Penawaran</a> -->
        </div>
    </div>

    <div class="mt-5 text-center">
        <h4 class="fw-semibold mb-3">Ingin Kerja Sama?</h4>
        <p class="text-muted">Hubungi kami untuk mendapatkan katalog produk, daftar harga khusus corporate, dan konsultasi proyek.</p>
        <a href="https://api.whatsapp.com/send/?phone=%2B6289526336995" class="btn btn-outline-success rounded-pill px-4">Hubungi Sekarang</a>
    </div>

    <!-- <div id="form-penawaran" class="mt-5">
        <h4 class="fw-semibold mb-3 text-center">Formulir Pengajuan Penawaran</h4>
        <form>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Nama Perusahaan" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Nomor Telepon" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Jenis Project / Produk yang Dibutuhkan" required>
                </div>
                <div class="col-12">
                    <textarea class="form-control" rows="4" placeholder="Keterangan Tambahan"></textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success rounded-pill px-5">Kirim</button>
                </div>
            </div>
        </form>
    </div> -->
</div>

<?= $this->endSection(); ?>