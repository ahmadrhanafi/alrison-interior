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
    <div class="text-center mb-4">
        <h1 class="fw-bold">Bantuan</h1>
        <p class="text-muted">Temukan panduan cepat dan solusi untuk berbagai kebutuhan Anda di Alrison Interior.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2"><i class="fas fa-user-plus text-success me-2"></i>Cara Mendaftar Akun</h5>
                    <p class="text-muted">Klik bars menu di pojok kanan atas halaman, lalu masuk ke <strong>Register</strong> untuk mengisi data lengkap Anda, lalu klik <strong>Daftar</strong> pada form tersebut.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2"><i class="fas fa-sign-in-alt text-success me-2"></i>Cara Masuk ke Akun</h5>
                    <p class="text-muted">Klik bars menu di pojok kanan atas halaman, lalu masuk ke <strong>Login</strong>, masukkan email dan password yang telah terdaftar, lalu klik <strong>Masuk</strong>.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2"><i class="fas fa-cart-plus text-success me-2"></i>Cara Menambahkan Produk ke Keranjang</h5>
                    <p class="text-muted">Pastikan Anda sudah melakukan Login, pilih produk yang diinginkan, lalu klik icon <strong><i class="fas fa-cart-plus"></i></strong> dan produk otomatis masuk ke keranjang belanja Anda.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2"><i class="fas fa-money-bill-wave text-success me-2"></i>Cara Melakukan Pembayaran</h5>
                    <p class="text-muted">Setelah berhasil membuat pesanan, klik bayar untuk menampilkan metode pembayaran yang tersedia, lalu pilih dan ikuti instruksinya.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2"><i class="fas fa-shipping-fast text-success me-2"></i>Cara Melacak Status Pesanan</h5>
                    <p class="text-muted">Gunakan fitur <strong>Cek Pesanan</strong> di menu, masukkan ID Pesanan Anda, lalu klik <strong>Lacak</strong> untuk melihat status terbaru.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2"><i class="fas fa-phone-alt text-success me-2"></i>Hubungi Layanan Pelanggan</h5>
                    <p class="text-muted">Jika Anda butuh bantuan langsung, hubungi kami di <strong>+62 812-3456-7890</strong> atau email ke <strong>cs@alrisoninterior.com</strong>.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="<?= base_url('pusat-bantuan') ?>" class="btn btn-success">Lihat Semua Panduan</a>
    </div>
</div>

<?= $this->endSection(); ?>