<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <di class="row justify-content-center">
            <div class="col-10">
                <h2 class="py-3">Edit Transaksi</h2>

                <form action="update_transaksi" method="post">
                    <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi">
                    <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                    
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label><br>
                        <select class="form-select" aria-label="Default select example" name="jenis_transaksi" id="jenis_transaksi" required>
                            <option selected value="<?= $transaksi['jenis_transaksi'] ?>">-- Pilih Jenis --</option>
                            <option value="Penjualan">Penjualan</option>
                            <option value="Pembelian">Pembelian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $transaksi['nama'] ?>" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. Handphone</label>
                        <input type="number" min="1" class="form-control" id="no_hp" name="no_hp" value="<?= $transaksi['no_hp'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $transaksi['alamat'] ?>" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="produk" class="form-label">Produk</label>
                        <input type="text" class="form-control" id="produk" name="produk" value="<?= $transaksi['produk'] ?>" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $transaksi['jumlah'] ?>" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="<?= $transaksi['harga'] ?>" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label><br>
                        <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                            <option selected value="<?= $transaksi['status'] ?>">-- Pilih Status --</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Tempo">Tempo</option>
                            <option value="Kredit">Kredit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="(Opsional)" value="<?= $transaksi['keterangan'] ?>">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 mb-5">Simpan</button>
                </form>
            </div>
        </di>
    </div>
</body>

<!-- Custom scripts for all pages-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>