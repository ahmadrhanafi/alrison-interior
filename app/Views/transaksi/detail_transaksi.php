<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() ?>/main-icon.png" type="image/x-icon">

    <style type="text/css">
        body {
            margin-top: 20px;
            background-color: #eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }

        @media screen {

            a#debug-icon-link,
            #debug-icon {
                display: none;
            }
        }
    </style>
</head>

<body >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

    <div class="container mb-4 mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <div class="mb-1">
                                <h2 class="mb-1 text-muted"><b style="color: #c00000;">Alrison Interior</b></h2>
                            </div>
                            <!-- <h6 class="float-end font-size-15 mb-4">Faktur #DS0204 <span class="badge bg-warning font-size-12 ms-2">Pending</span></h6> -->
                            <div class="text-muted">
                                <p class="mb-1">Jln. Raya Parung Bogor, Kp. Jati Rt. 03/03, Parung, Jawa Barat, Indonesia 16330.</p>
                                <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5a2223201a63626d74393537">alrisoninterior00@gmail.com</a></p>
                                <p><i class="uil uil-phone me-1"></i> 089526336995</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Pemesan :</h5>
                                    <h5 class="font-size-15 mb-2"><?= $transaksi['nama']; ?></h5>
                                    <p class="mb-1"><?= $transaksi['alamat']; ?></p>
                                    <!-- <p class="mb-1"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="efbf9d8a9c9b8081a28683838a9daf8e9d82969c9f96c18c8082">[email&#160;protected]</a></p> -->
                                    <p><?= $transaksi['no_hp']; ?></p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">No Transaksi :</h5>
                                        <p>#<?= $transaksi['kode_transaksi'];  ?></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Tanggal :</h5>
                                        <p><?= $transaksi['created_at'];  ?></p>
                                    </div>
                                    <!-- <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">No Pesanan :</h5>
                                        <p>#1123456</p>
                                    </div> -->
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2">
                            <h5 class="font-size-15 mb-3">Ringkasan Pesanan</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th class="text-end" style="width: 120px;">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <!-- end thead -->

                                    <?php $no = 1; ?>

                                    <?php foreach ($detailTransaksi as $transaksi): ?>
                                        

                                        <tbody>
                                            <tr>
                                                <th scope="row"><?= $no++; ?></th>
                                                <td>
                                                    <div>
                                                        <h6 class="text-truncate font-size-8 mb-1"><?= $transaksi['produk']; ?></h6>
                                                    </div>
                                                </td>
                                                <td>Rp<?= number_format($transaksi['harga'], 0, '.', '.'); ?></td>
                                                <td><?= $transaksi['jumlah']; ?></td>
                                                <td class="text-end">Rp<?= number_format($transaksi['harga'] * $transaksi['jumlah'], 0, '.', '.') ?></td>
                                            </tr>
                                            <!-- end tr -->

                                            <!-- <tr>
                                            <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                            <td class="text-end">$732.50</td>
                                        </tr> -->

                                            <!-- end tr -->
                                            <!-- <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Discount :</th>
                                            <td class="border-0 text-end">- $25.50</td>
                                        </tr> -->

                                            <!-- end tr -->
                                            <!-- <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Shipping Charge :</th>
                                            <td class="border-0 text-end">$20.00</td>
                                        </tr> -->

                                            <!-- end tr -->
                                            <!-- <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Tax</th>
                                            <td class="border-0 text-end">$12.00</td>
                                        </tr> -->

                                            <!-- end tr -->
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0 fw-semibold">Rp<?= number_format($transaksi['harga'] * $transaksi['jumlah'], 0, '.', '.') ?></h4>
                                                </td>
                                            </tr>
                                            <!-- end tr -->
                                        <?php endforeach; ?>
                                        </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                    <a href="#" class="btn btn-primary w-md">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>