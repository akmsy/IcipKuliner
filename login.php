<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
            <p class="small-title">WELCOME BACK</p>
            <h2 class="fw-bold">Sign In</h2>
            <p class="desc">
                Return to your curated collection of regional heritage
                and culinary stories.
            </p>

            <!-- Form -->
            <form action="proses_login.php" method="POST">
                <label>Email Address</label>
                <input type="email"
                    name="email"
                    class="form-control custom-input"
                    placeholder="chef@editorial.com"
                    required>

                <div class="d-flex justify-content-between mt-3">
                    <label>Password</label>
                    <small class="forgot">Forgot password?</small>
                </div>

                <input type="password"
                    name="password"
                    class="form-control custom-input"
                    placeholder="********"
                    required>

                <div class="form-check mt-3">
                    <input class="form-check-input"
                        type="checkbox">
                    <label class="form-check-label">Keep me logged in</label>
                </div>

                <button type="submit" class="btn login-btn w-100 mt-4">
                    Login →
                </button>

            </form>

            <!-- Connect -->
            <p class="or-text">OR CONNECT WITH</p>

            <div class="d-flex gap-3">
                <button class="btn social-btn w-50">
                    Google
                </button>
                <button class="btn social-btn w-50">
                    Apple
                </button>
            </div>

            <p class="register-text">Don't have an account?
                <a href="register.php">Register now</a>
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