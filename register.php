<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Register</title>
</head>
<body>
    <!-- Navbar -->
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <!-- Main -->
    <main>
        <section class="login-section d-flex align-items-center justify-content-center">

    <div class="login-card">
        <p class="small-title">KONTRIBUTOR BARU</p>
        <h2 class="fw-bold">Buat Akun</h2>
        <p class="desc">
            Bergabunglah dengan komunitas penjelajah kuliner Nusantara.
        </p>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger py-2" role="alert">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Form -->
        <form action="proses_register.php" method="POST">
            <label>Nama Lengkap</label>
            <input type="text"
                   name="username"
                   class="form-control custom-input"
                   placeholder="Julianne Smith"
                   required>

            <label class="mt-3">Alamat Email</label>
            <input type="email"
                   name="email"
                   class="form-control custom-input"
                   placeholder="julianne@editorial.com"
                   required>

            <div class="row mt-3">
                <div class="col-6">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control custom-input"
                           placeholder="••••••••"
                           minlength="6"
                           required>
                </div>

                <div class="col-6">
                    <label>Konfirmasi</label>
                    <input type="password"
                           name="password"
                           class="form-control custom-input"
                           placeholder="••••••••"
                           minlength="6"
                           required>
                </div>
            </div>

            <div class="form-check mt-3">
                <input class="form-check-input"
                       type="checkbox"
                       required>
                <label class="form-check-label checkbox-text">
                    Saya menyetujui <span>Syarat & Ketentuan</span> dan <span>Kebijakan Privasi</span>.
                </label>
            </div>

            <button type="submit" class="btn register-btn w-100 mt-4">
                Daftar →
            </button>
        </form>

        <p class="register-text">Sudah punya akun?
            <a href="login.php">Masuk</a>
        </p>
    </div>

        </section>

    </main>

   <!-- Footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>
</html> 