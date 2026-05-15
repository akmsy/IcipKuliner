<?php 
    include 'koneksi.php';
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar bg-body-light shadow-sm">
    <div class="container-fluid">
        
        <div class="d-flex align-items-center">
            <img src="img/logo.png" width="50" height="50" class="me-2">
            <a class="navbar-brand fw-bold" href="index.php">IcipKuliner</a>
        </div>

        <div class="d-flex">
            <a href="index.php" class="nav-link me-3 
                <?= ($currentPage == 'index.php') ? 'active-link' : '' ?>">
                Home
            </a>
            <a href="explore.php" class="nav-link me-3 
                <?= ($currentPage == 'explore.php') ? 'active-link' : '' ?>">
                Explore
            </a>
            <a href="contribute.php" class="nav-link me-3 
                <?= ($currentPage == 'contribute.php') ? 'active-link' : '' ?>">
                Contribute
            </a>
        </div>

        <div class="d-flex align-items-center">
        <?php if (!isset($_SESSION['logged_in'])): ?>
            <a href="login.php" class="btn btn-outline-orange rounded-pill px-4 me-3">Login</a>
            <a href="register.php" class="btn btn-orange rounded-pill px-4">Register</a>
        <?php else: ?>

            <div class="dropdown ms-2">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="img/profil.png" width="40" height="40" class="rounded-circle border border-2 border-warning shadow-sm">
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow p-2">
                    <li class="px-3 py-2 text-center">
                        <div class="fw-semibold">Profil</div>
                        <small class="text-muted">Akun</small>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-white bg-danger rounded text-center" href="logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>

        <?php endif; ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</nav>