<?= $this->extend('layout/statis'); ?>

<?= $this->section('content'); ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">Kebijakan & Privasi</h3>
        <p class="text-muted">Kami berkomitmen menjaga privasi dan keamanan data pelanggan dalam setiap transaksi di Alrison Interior.</p>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-4 mb-3">
            <div class="p-4 bg-light rounded-3 shadow-sm h-100">
                <i class="bi bi-lock-fill fs-1 text-primary"></i>
                <h5 class="mt-3">Keamanan Data</h5>
                <p class="text-muted">Seluruh data pelanggan disimpan dengan sistem keamanan berlapis dan terenkripsi.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="p-4 bg-light rounded-3 shadow-sm h-100">
                <i class="bi bi-person-check-fill fs-1 text-success"></i>
                <h5 class="mt-3">Privasi Pengguna</h5>
                <p class="text-muted">Kami tidak membagikan informasi pribadi tanpa izin tertulis dari pengguna.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="p-4 bg-light rounded-3 shadow-sm h-100">
                <i class="bi bi-shield-lock-fill fs-1 text-warning"></i>
                <h5 class="mt-3">Kerahasiaan Transaksi</h5>
                <p class="text-muted">Seluruh aktivitas pembayaran diamankan dengan sistem payment gateway.</p>
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionPrivacy">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Data yang Kami Kumpulkan
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionPrivacy">
                <div class="accordion-body text-muted">
                    Kami mengumpulkan data berupa nama, alamat email, nomor telepon, dan alamat pengiriman yang dibutuhkan untuk keperluan transaksi dan layanan pelanggan.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Penggunaan Data Pelanggan
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionPrivacy">
                <div class="accordion-body text-muted">
                    Data pelanggan digunakan untuk keperluan konfirmasi pesanan, pengiriman produk, promosi khusus, serta peningkatan layanan sesuai persetujuan Anda.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Hak Pelanggan atas Data
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionPrivacy">
                <div class="accordion-body text-muted">
                    Pelanggan berhak mengakses, mengubah, atau meminta penghapusan data pribadi yang tersimpan di sistem Alrison Interior sesuai ketentuan yang berlaku.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Keamanan Informasi
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionPrivacy">
                <div class="accordion-body text-muted">
                    Kami menerapkan sistem keamanan berlapis dan melakukan audit berkala untuk melindungi data pelanggan dari akses yang tidak sah atau penyalahgunaan.
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>