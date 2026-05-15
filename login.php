<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Login</title>
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
            <p class="small-title">SELAMAT DATANG KEMBALI</p>
            <h2 class="fw-bold">Masuk</h2>
            <p class="desc">
                Kembali ke koleksi kuliner warisan daerahmu.
            </p>

            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="alert alert-danger py-2" role="alert">
                    <?= htmlspecialchars($_SESSION['login_error']); ?>
                </div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <!-- Form -->
            <form action="proses_login.php" method="POST">
                <label>Alamat Email</label>
                <input type="email"
                    name="email"
                    class="form-control custom-input"
                    placeholder="contoh@gmail.com"
                    required>

                <div class="d-flex justify-content-between mt-3">
                    <label>Password</label>
                </div>

                <input type="password"
                    name="password"
                    class="form-control custom-input"
                    placeholder="********"
                    required>

                <div class="form-check mt-3">
                    <input class="form-check-input"
                        type="checkbox">
                    <label class="form-check-label">Tetap Masuk</label>
                </div>

                <button type="submit" class="btn login-btn w-100 mt-4">
                    Masuk →
                </button>

            </form>

            <p class="register-text">Belum punya akun?
                <a href="register.php">Daftar sekarang</a>
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