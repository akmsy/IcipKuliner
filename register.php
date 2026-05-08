<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
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
        <p class="small-title">NEW CONTRIBUTOR</p>
        <h2 class="fw-bold">Create Account</h2>
        <p class="desc">
            Join our community of chefs, writers, and explorers
            sharing the world's table. 
        </p>

        <!-- Form -->
        <form action="proses_register.php" method="POST">
            <label>Full Name</label>
            <input type="text"
                   name="username"
                   class="form-control custom-input"
                   placeholder="Julianne Smith"
                   required>

            <label class="mt-3">Email Address</label>
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
                           required>
                </div>

                <div class="col-6">
                    <label>Confirm</label>
                    <input type="password"
                           name="password"
                           class="form-control custom-input"
                           placeholder="••••••••"
                           required>
                </div>
            </div>

            <div class="form-check mt-3">
                <input class="form-check-input"
                       type="checkbox"
                       required>
                <label class="form-check-label checkbox-text">
                    I agree to the <span>Terms of Service</span> and <span> Privacy Policy </span>regarding regional heritage data preservation.
                </label>
            </div>

            <button type="submit" class="btn register-btn w-100 mt-4">
                Register →
            </button>
        </form>

        <p class="register-text">Already have an account?
            <a href="login.php">Sign In</a>
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