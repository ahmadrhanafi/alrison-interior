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
        <h3 class="fw-bold">— FAQ —<br>Pertanyaan yang Sering Diajukan</h3>
        <p class="text-muted">Temukan jawaban atas pertanyaan umum seputar layanan dan produk di Alrison Interior.</p>
    </div>

    <div class="accordion" id="faqAccordion">

        <!-- FAQ 1 -->
        <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                    Bagaimana cara mendaftar akun di Alrison Interior?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                    Klik tombol <strong>Daftar</strong> di pojok kanan atas halaman, isi data lengkap Anda, lalu klik <strong>Buat Akun</strong>. Akun Anda akan langsung aktif setelah pendaftaran berhasil.
                </div>
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    Apakah bisa memesan produk tanpa mendaftar akun?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                    Maaf, saat ini hanya pengguna yang sudah memiliki akun yang dapat melakukan pemesanan produk di website kami untuk keamanan dan kemudahan transaksi.
                </div>
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    Bagaimana proses pembayaran dilakukan?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                    Setelah checkout, Anda akan diarahkan ke halaman pilihan metode pembayaran. Silakan pilih metode yang diinginkan lalu ikuti instruksi pembayaran yang muncul. Sistem kami akan otomatis mendeteksi pembayaran Anda.
                </div>
            </div>
        </div>

        <!-- FAQ 4 -->
        <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                    Apakah produk bisa dikembalikan atau ditukar?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                    Anda dapat melakukan pengembalian atau penukaran produk jika terdapat kerusakan atau ketidaksesuaian pesanan maksimal 3 hari setelah barang diterima. Silakan hubungi layanan pelanggan untuk proses lebih lanjut.
                </div>
            </div>
        </div>

        <!-- FAQ 5 -->
        <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                    Bagaimana cara melacak status pesanan saya?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                    Masuk ke akun Anda, lalu klik menu <strong>Cek Pesanan</strong>. Masukkan ID Pesanan Anda, kemudian klik <strong>Lacak</strong> untuk melihat detail status pengiriman pesanan.
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-5">
        <a href="<?= base_url('dukungan/bantuan-dukungan') ?>" class="btn btn-success">Kembali ke Bantuan</a>
    </div>
</div>

<?= $this->endSection(); ?>