<?= $this->extend('layout/statis'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="container my-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">Syarat & Ketentuan</h3>
        <p class="text-muted">Selamat datang di Alrison Interior — mohon baca ketentuan kami sebelum melakukan transaksi.</p>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h4 class="fw-semibold">1. Ketentuan Umum</h4>
            <p class="text-muted">
                Dengan menggunakan layanan website ini, Anda dianggap telah membaca, memahami, dan menyetujui semua isi dalam syarat & ketentuan ini. Jika Anda tidak setuju, kami sarankan untuk tidak menggunakan layanan kami.
            </p>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h4 class="fw-semibold">2. Pemesanan Produk</h4>
            <ul class="text-muted">
                <li>Seluruh produk yang tersedia dapat dipesan melalui website ini setelah Anda login ke akun Anda.</li>
                <li>Pastikan detail pesanan seperti jumlah, ukuran, dan spesifikasi produk sudah sesuai sebelum checkout.</li>
                <li>Pemesanan dianggap sah setelah Anda menyelesaikan proses pembayaran.</li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h4 class="fw-semibold">3. Pembayaran</h4>
            <ul class="text-muted">
                <li>Pembayaran dilakukan melalui metode yang telah kami sediakan di halaman checkout.</li>
                <li>Konfirmasi pembayaran wajib dilakukan agar pesanan dapat segera diproses.</li>
                <li>Jika dalam 1x24 jam tidak ada konfirmasi pembayaran, maka pesanan otomatis dibatalkan.</li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h4 class="fw-semibold">4. Pengiriman</h4>
            <p class="text-muted">
                Waktu pengiriman disesuaikan dengan lokasi Anda dan estimasi yang tertera saat checkout. Kami berkomitmen untuk mengirimkan produk dalam kondisi baik sesuai pesanan.
            </p>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h4 class="fw-semibold">5. Pengembalian Barang</h4>
            <ul class="text-muted">
                <li>Pengembalian hanya berlaku untuk produk cacat produksi atau salah kirim.</li>
                <li>Pengajuan retur maksimal 2x24 jam setelah barang diterima dengan menyertakan bukti foto/video.</li>
                <li>Biaya retur ditanggung sesuai ketentuan yang berlaku.</li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h4 class="fw-semibold">6. Perubahan Ketentuan</h4>
            <p class="text-muted">
                Kami berhak sewaktu-waktu mengubah ketentuan ini tanpa pemberitahuan terlebih dahulu. Syarat & Ketentuan yang berlaku adalah yang terbaru yang tercantum di halaman ini.
            </p>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="<?= base_url('web') ?>" class="btn btn-primary rounded-pill px-4">Kembali ke Beranda</a>
    </div>
</div>

<?= $this->endSection(); ?>