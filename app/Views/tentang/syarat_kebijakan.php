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
        <h3 class="fw-bold">Syarat & Kebijakan</h3>
        <p class="text-muted">Selamat datang di Alrison Interior. Mohon baca dengan seksama syarat penggunaan layanan dan kebijakan privasi kami sebelum menggunakan website dan layanan yang tersedia.</p>
    </div>

    <div class="mb-5">
        <h4 class="fw-semibold mb-3">Syarat & Ketentuan Penggunaan</h4>
        <p class="text-muted">Dengan mengakses dan menggunakan situs <strong>Alrison Interior</strong>, Anda dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku, di antaranya:</p>
        <ul class="text-muted">
            <li>Menggunakan situs untuk tujuan yang sah dan tidak melanggar hukum.</li>
            <li>Dilarang melakukan aktivitas yang dapat merugikan atau mengganggu layanan situs.</li>
            <li>Seluruh konten, gambar, dan materi dalam situs ini dilindungi hak cipta dan dilarang disalin tanpa izin tertulis.</li>
            <li>Harga produk dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya.</li>
            <li>Pemesanan dianggap sah setelah pembayaran diterima dan diverifikasi oleh pihak kami.</li>
        </ul>
    </div>

    <div class="mb-5">
        <h4 class="fw-semibold mb-3">Kebijakan Privasi</h4>
        <p class="text-muted">Kami menghargai privasi setiap pengguna. Informasi pribadi yang Anda berikan saat menggunakan layanan kami akan kami jaga kerahasiaannya sesuai dengan ketentuan berikut:</p>
        <ul class="text-muted">
            <li>Data pribadi seperti nama, alamat email, nomor telepon, dan alamat pengiriman hanya digunakan untuk keperluan transaksi dan layanan pelanggan.</li>
            <li>Kami tidak akan membagikan atau menjual informasi pribadi Anda kepada pihak ketiga tanpa adannya persetujuan dari Anda.</li>
            <!-- <li>Situs kami menggunakan cookies untuk meningkatkan pengalaman pengguna dan mengingat preferensi Anda di kunjungan berikutnya.</li> -->
            <li>Kami menjaga keamanan data pelanggan dengan sistem keamanan berlapis sesuai standar industri.</li>
        </ul>
    </div>

    <div class="text-center">
        <h5 class="fw-semibold mb-3">Hubungi Kami</h5>
        <p class="text-muted">Jika Anda memiliki pertanyaan terkait syarat penggunaan atau kebijakan privasi, silakan hubungi kami melalui:</p>
        <p><i class="fas fa-envelope text-success me-2"></i>cs@alrisoninterior.com</p>
        <p><i class="fas fa-phone text-success me-2"></i>+62 812-3456-7890</p>
    </div>
</div>


<?= $this->endSection(); ?>