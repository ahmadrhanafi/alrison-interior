<?= $this->extend('layout/statis'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="container py-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold text-primary">Pusat Bantuan</h3>
        <p class="text-muted">Temukan jawaban atas pertanyaan Anda seputar layanan Alrison Interior</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold"><i class="fas fa-question-circle text-primary me-2"></i> Bagaimana cara memesan produk?</h5>
                    <p class="text-muted">Silakan pilih produk yang Anda inginkan, lalu klik tombol <strong>"Order"</strong> atau <strong>"Tambah ke Keranjang"</strong>. Setelah itu, lanjut ke halaman checkout untuk melakukan pembayaran.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold"><i class="fas fa-truck text-primary me-2"></i> Berapa lama waktu pengiriman?</h5>
                    <p class="text-muted">Estimasi pengiriman adalah 3-7 hari kerja setelah pembayaran diterima. Tergantung lokasi dan ketersediaan stok.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold"><i class="fas fa-credit-card text-primary me-2"></i> Metode pembayaran apa saja yang tersedia?</h5>
                    <p class="text-muted">Kami menerima pembayaran melalui Transfer Bank, E-Wallet, dan Virtual Account via Midtrans.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold"><i class="fas fa-sync-alt text-primary me-2"></i> Apakah bisa retur atau tukar barang?</h5>
                    <p class="text-muted">Bisa, silakan ajukan permintaan retur melalui menu <strong><a href="<?= base_url('pusat-panggilan') ?>">Pusat Panggilan</a></strong> maksimal 3 hari setelah barang diterima.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="<?= base_url('pusat-panggilan') ?>" class="btn btn-primary btn-lg rounded-pill px-4">
            Hubungi Kami
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection(); ?>