<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Explore</title>
</head>

<body>
    <!-- Navbar -->
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <!-- Main -->
    <main>
        <div class="container-fluid main-container">

        <!-- Filter -->
        <div class="filter-box">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="filter-label">KABUPATEN</label>
                    <select id="kabupaten" class="form-select custom-select">
                        <option value="">Pilih Kabupaten</option>
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT id_kabupaten, nama_kabupaten FROM kabupaten");
                            while ($data = mysqli_fetch_array($query)){
                        ?>
                        <option value="<?= $data['id_kabupaten'] ?>"><?= $data['nama_kabupaten'] ?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="filter-label">KECAMATAN</label>
                    <select id="kecamatan" class="form-select custom-select">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="filter-label">DESA</label>
                    <select id="desa" class="form-select custom-select">
                        <option value="">Pilih Desa</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn search-btn w-100">
                        Cari Kuliner
                    </button>
                </div>
            </div>
        </div>

        <!-- Hero -->
        <section class="hero-section">

            <div class="hero-text">
                <p class="orange">REKOMENDASI BERDASARKAN LOKASI SAAT INI</p>
                <h1>Cita Rasa Autentik <span>Yogyakarta</span></h1>
                <p class="hero-desc">
                    Temukan 142 rekomendasi kuliner, mulai dari gudeg legendaris hingga kafe modern di jantung Kota Yogyakarta. Jelajahi kekayaan rasa dan budaya Jawa dalam setiap hidangan.
                </p>
            </div>

            <div class="hero-image"></div>
        </section>

        <!-- Food -->
            <div class="container py-4 mt-5">
                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="food-card">
                            <img src="img/gudeg.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Gudeg Yu Djum</h5>
                                    <span class="rating-box">★ 4.8</span>
                                </div>
                                <p class="price">Rp. 25.000–50.000</p>
                                <p class="location"><i class="bi bi-geo-alt"></i> Jl. Wijilan No.167, Kraton</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="food-card">
                            <img src="img/kopi.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Kopi Jos Lik Man</h5>
                                    <span class="rating-box">★ 4.7</span>
                                </div>
                                <p class="price">Rp. 5.000–20.000</p>
                                <p class="location"><i class="bi bi-geo-alt"></i> Wirobrajan, Gedong Tengen</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="food-card">
                            <img src="img/sate.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Sate Klatak Pak Bari</h5>
                                    <span class="rating-box">★ 4.8</span>
                                </div>
                                <p class="price">Rp. 25.000–50.000</p>
                                <p class="location"><i class="bi bi-geo-alt"></i> Pasar Wonokromo, Bantul</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="food-card">
                            <img src="img/bakpia.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Bakpia Pathok 25</h5>
                                    <span class="rating-box">★ 4.6</span>
                                </div>
                                <p class="price">Rp. 30.000–60.000</p>
                                <p class="location"><i class="bi bi-geo-alt"></i> Suryodiningratan NS4, Pathok</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagination-box">
                    <span class="page"><</span>
                    <span class="page active-page">1</span>
                    <span class="page">2</span>
                    <span class="page">3</span>
                    <span class="page">></span>
                </div>
            </div>
            </div>
        </div>

    </main>

   <!-- Footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="script.js"></script>

</html> 