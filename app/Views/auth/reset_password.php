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

        .reset-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .card-reset {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            max-width: 420px;
            width: 100%;
        }

        .card-reset h3 {
            font-weight: 800;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-reset {
            background-color: #004fcc;
            border: none;
        }

        .btn-reset:hover {
            background-color: #003fa3;
        }

        .footer-text {
            margin-top: 3rem;
            font-size: 0.85rem;
            color: #666;
            text-align: center;
        }

        @media (max-width: 576px) {
            .card-reset {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>

    <div class="reset-container">
        <h3 class="mb-4">Reset Password</h3>
        <div class="card-reset">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('reset-password/' . $token) ?>">

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <div class="position-relative">
                        <input type="password" id="password" name="password" class="form-control" required>
                        <i class="fas fa-eye-slash position-absolute top-50 end-0 translate-middle-y me-3"
                            style="cursor: pointer;"
                            onclick="togglePassword('password', this)"></i>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="confirm" class="form-label">Konfirmasi Password</label>
                    <div class="position-relative">
                        <input type="password" id="confirm" name="confirm" class="form-control" required>
                        <i class="fas fa-eye-slash position-absolute top-50 end-0 translate-middle-y me-3"
                            style="cursor: pointer;"
                            onclick="togglePassword('confirm', this)"></i>
                    </div>
                </div>

                <hr>

                <div class="d-grid">
                    <button type="submit" class="btn btn-reset text-white">Reset Password</button>
                </div>

            </form>
        </div>

        <div class="footer-text">
            <small>Copyright &copy; 2025 <b>Alrison Interior.</b> All Rights Reserved</small>
        </div>
    </div>

    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                el.classList.remove('fa-eye-slash');
                el.classList.add('fa-eye');
            } else {
                input.type = "password";
                el.classList.remove('fa-eye');
                el.classList.add('fa-eye-slash');
            }
        }
    </script>

</body>

</html>