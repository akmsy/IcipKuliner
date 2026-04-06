<?php 
    if (!$login) {
        ?>
        <nav class="navbar bg-body-light shadow-sm">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <img src="img/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top me-2">
                    <a class="navbar-brand fw-bold" href="index.php">IcipKuliner</a>
                </div>

                <div class="d-flex">
                    <a href="index.php" class="nav-link me-3">Home</a>
                    <a href="explore.php" class="nav-link me-3">Explore</a>
                    <a href="contribute.php" class="nav-link">Contribute</a>
                </div>

                <div class="d-flex">
                    <a href="login.php" class="btn btn-outline-orange rounded rounded-pill px-4 me-3">Login</a>
                    <a href="register.php" class="btn btn-orange rounded-pill px-4">Register</a>
                </div>
            </div>
        </nav>
    <?php 
    } 
    else {
        ?>
        <nav class="navbar bg-body-light">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <img src="img/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top me-2">
                    <a class="navbar-brand fw-bold" href="index.php">IcipKuliner</a>
                </div>

                <div class="d-flex">
                    <a href="index.php" class="nav-link me-3">Home</a>
                    <a href="explore.php" class="nav-link me-3">Explore</a>
                    <a href="contribute.php" class="nav-link">Contribute</a>
                </div>

                <div class="d-flex align-items-center">
                    <form class="form-inline my-2 my-lg-0" action="search.php" method="$_GET">
                        <input class="form-control mr-sm-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <img src="img/profil.png" alt="Profile" width="40" height="40" class="rounded-circle ms-2">
                </div>
            </div>
        </nav>
    <?php
    }
?>