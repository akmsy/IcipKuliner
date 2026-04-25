<?php 
session_start();
include 'koneksi.php';
?>

<nav class="navbar bg-body-light shadow-sm">
    <div class="container-fluid">
        
        <div class="d-flex align-items-center">
            <img src="img/logo.png" width="50" height="50" class="me-2">
            <a class="navbar-brand fw-bold" href="index.php">IcipKuliner</a>
        </div>

        <div class="d-flex">
            <a href="index.php" class="nav-link me-3">Home</a>
            <a href="explore.php" class="nav-link me-3">Explore</a>
            <a href="contribute.php" class="nav-link">Contribute</a>
        </div>

        <div class="d-flex align-items-center">
        <?php if (!isset($_SESSION['logged_in'])): ?>

            <a href="login.php" class="btn btn-outline-orange rounded-pill px-4 me-3">Login</a>
            <a href="register.php" class="btn btn-orange rounded-pill px-4">Register</a>

        <?php else: ?>

            <form action="search.php" method="GET">
                <input class="form-control rounded-pill" type="search" name="keyword" placeholder="Search">
            </form>
            <img src="img/profil.png" width="40" height="40" class="rounded-circle ms-2">

        <?php endif; ?>
        </div>

    </div>
</nav>