<?php
    include 'koneksi.php';

    $query = mysqli_query($koneksi,
        "SELECT 
        k.id_kuliner,
        k.nama_tempat,
        k.lokasi,
        k.deskripsi,
        k.gambar,
        COALESCE(AVG(u.rating), 0) AS avg_rating
        FROM kuliner k
        LEFT JOIN ulasan u ON k.id_kuliner = u.kuliner_id
        GROUP BY k.id_kuliner
        ORDER BY avg_rating DESC
        LIMIT 3"
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Home</title>
</head>
<body>
    <!-- Navbar -->
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <!-- Main Content -->
    <main>

        <!-- Hero Section -->
        <section class="container">
            <div class="row align-items-center min-vh-100">

                <article class="col-md-6">
                    <h6>WARISAN NUSANTARA</h6>
                    <h1 class="fw-bold">Cari Kuliner Terdekat di Daerahmu</h1>
                    <p>
                        Jelajahi cita rasa warisan Nusantara yang tersembunyi di setiap sudut daerah.
                        Temukan resep keluarga dan hidangan otentik dari segala penjuru daerah.
                    </p>
                    <a href="explore.php" class="btn btn-orange rounded-pill px-4 mt-2">
                        Jelajahi Sekarang <i class="bi bi-arrow-right"></i>
                    </a>
                </article>

                <figure class="col-md-6 d-flex justify-content-center">
                    <div class="card-wrapper">

                        <div class="image-stack">
                            <?php
                                $images = [
                                    "img/kuliner.jpg",
                                    "img/petakuliner.jpg"
                                ];
                            ?>

                            <?php foreach ($images as $index => $img): ?>
                                <div class="custom-card <?php echo $index === 0 ? 'back' : 'front'; ?>">
                                    <img src="<?php echo $img; ?>" alt="Kuliner Nusantara">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <figcaption class="bubble">
                            "Jiwa suatu daerah terletak pada rempah-rempahnya"
                        </figcaption>

                    </div>
                </figure>

            </div>
        </section>
        
        <!-- TOP KULINER -->
        <section class="py-5 bg-birumuda">
            <div class="container">
                <header class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <p class="text-uppercase text-muted mb-1">Regional Spotlight</p>
                        <h2 class="fw-bold">Top Kuliner di Yogyakarta</h2>
                    </div>
                    <a href="explore.php" class="text-decoration-none">
                        Lihat semua <i class="bi bi-arrow-right"></i>
                    </a>
                </header>
                <div class="row g-4">
                    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                    <article class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="img/<?= $data['gambar']; ?>" 
                                class="card-img-top" 
                                alt="<?= $data['nama_tempat']; ?>">
                            <div class="card-body">
                                <small class="text-muted">
                                    <?= $data['lokasi']; ?>
                                </small>
                                <h5 class="fw-bold">
                                    <?= $data['nama_tempat']; ?>
                                    <span class="text-warning">
                                        ⭐ <?= number_format($data['avg_rating'], 1); ?>
                                    </span>
                                </h5>
                                <p class="text-muted">
                                    <?= $data['deskripsi']; ?>
                                </p>
                            </div>
                        </div>
                    </article>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <aside class="cta-box p-5 d-flex justify-content-between align-items-center flex-wrap">

                    <div class="cta-text">
                        <h2 class="fw-bold text-white">Bagikan<br>Rekomendasi Anda</h2>
                        <p class="mt-3 text-white">
                            Punya hidden gem kuliner yang layak dikenal? Yuk bagikan ke komunitas
                            dan bantu lestarikan warisan kuliner Nusantara.
                        </p>
                        <a href="contribute.php" class="btn btn-light mt-3">
                            Submit Spot <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <div class="cta-card p-4 mt-4 mt-md-0 text-white">
                        <small><i class="bi bi-shield-check"></i> Community Trusted</small>
                        <p class="mt-2 mb-3">
                            Setiap kontribusi akan direview oleh tim kurator untuk menjaga kualitas.
                        </p>

                        <div class="d-flex align-items-center">
                            <img src="img/user1.jpg" class="avatar">
                            <img src="img/user2.jpg" class="avatar">
                            <img src="img/user3.jpg" class="avatar">
                            <span class="ms-2">+2k</span>
                        </div>
                    </div>

                </aside>
            </div>
        </section>
        
    </main>

    <!-- Footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>
</html>