<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/main-icon.png" type="image/x-icon">

    <style>
        body {
            background-color: aliceblue;
            font-family: 'Segoe UI', sans-serif;
        }

        .alert-custom {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .forgot-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .card-forgot {
            background: #fff;
            padding: 2.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            max-width: 420px;
            width: 100%;
        }

        .card-forgot h5 {
            font-weight: 800;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-forgot {
            background-color: #004fcc;
            border: none;
        }

        .btn-forgot:hover {
            background-color: #003fa3;
        }

        .footer-text {
            margin-top: 3rem;
            font-size: 0.85rem;
            color: #666;
            text-align: center;
        }

        @media (max-width: 576px) {
            .card-forgot {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>

    <div class="forgot-container">
        <h5 class="mb-4">Lupa Password</h5>
        <div class="card-forgot rounded">

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-custom"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('forgot-password') ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Anda</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan alamat email" required>
                </div>
                <hr>
                <div class="d-grid">
                    <button type="submit" class="btn btn-forgot text-white">Kirim Link Reset</button>
                </div>
            </form>
        </div>

        <div class="footer-text">
            <small>Copyright &copy; 2025 <b>Alrison Interior.</b> All Rights Reserved</small>
        </div>
    </div>

</body>

</html>