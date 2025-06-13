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
        <h3 class="fw-bold">Tentang Kami</h3>
        <p class="text-muted">Kenali lebih dekat Alrison Interior — penyedia solusi furnitur dan desain interior premium untuk hunian maupun bisnis Anda.</p>
    </div>

    <div class="row g-4 align-items-center">
        <div class="col-md-6">
            <img src="<?= base_url('main-about.jpg') ?>" class="img-fluid rounded-4 shadow" alt="Tentang Kami">
        </div>
        <div class="col-md-6">
            <h4 class="fw-semibold mb-3">Mewujudkan Interior Impian Sejak 2000</h4>
            <p class="text-muted">Alrison Interior hadir sebagai solusi lengkap kebutuhan furnitur custom dan desain interior berkualitas tinggi. Kami berkomitmen memberikan produk terbaik dengan sentuhan estetika dan fungsionalitas yang seimbang, didukung tenaga ahli berpengalaman di bidangnya.</p>
            <ul class="list-unstyled text-muted">
                <li><i class="fas fa-check-circle text-success me-2"></i> Desain eksklusif & bisa custom</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Material berkualitas premium</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Tim desainer & tenaga produksi profesional</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Interior rumah, kantor, hingga komersial</li>
            </ul>
        </div>
    </div>

    <div class="text-center my-5">
        <h4 class="fw-semibold mb-3">Visi & Misi Kami</h4>
    </div>

    <div class="row text-center g-4">
        <div class="col-md-6">
            <div class="p-4 border rounded-4 shadow-sm h-100">
                <h5 class="fw-bold mb-3">Visi</h5>
                <p class="text-muted">Menjadi perusahaan furnitur dan desain interior terbaik yang memberikan inspirasi, kenyamanan, dan nilai estetika tinggi bagi setiap ruang.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 border rounded-4 shadow-sm h-100">
                <h5 class="fw-bold mb-3">Misi</h5>
                <ul class="list-unstyled text-muted text-start">
                    <li><i class="fas fa-circle text-success me-2 fs-6"></i> Memberikan layanan terbaik kepada pelanggan</li>
                    <li><i class="fas fa-circle text-success me-2 fs-6"></i> Menghadirkan produk furnitur berkualitas dan inovatif</li>
                    <li><i class="fas fa-circle text-success me-2 fs-6"></i> Berkontribusi dalam pengembangan interior Indonesia</li>
                    <li><i class="fas fa-circle text-success me-2 fs-6"></i> Membangun hubungan baik & berkelanjutan dengan pelanggan dan mitra</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <h4 class="fw-semibold mb-3">Alrison Interior — Lebih dari Sekadar Furnitur</h4>
        <p class="text-muted">Kami percaya bahwa setiap ruang punya cerita. Kami hadir untuk menciptakan cerita indah melalui desain interior yang berkualitas, nyaman, dan berkarakter.</p>
    </div>
</div>

<?= $this->endSection(); ?>