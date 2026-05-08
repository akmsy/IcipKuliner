<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
                    <label class="filter-label">PROVINSI</label>
                    <select id="provinsi" class="form-select custom-select">
                        <option value="">Pilih Provinsi</option>
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT id, name FROM reg_provinces");
                            while ($data = mysqli_fetch_array($query)){
                        ?>
                        <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="filter-label">KABUPATEN/KOTA</label>
                    <select id="kabupaten" class="form-select custom-select">
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="filter-label">KECAMATAN/DESA</label>
                    <select id="kecamatan" class="form-select custom-select">
                        <option value="">Pilih Kecamatan/Desa</option>
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
                <p class="orange">CURRENT LOCATION RECOMMENDATIONS</p>
                <h1>Authentic Flavors of <span>Yogyakarta</span></h1>
                <p class="hero-desc">
                    Discover 142 hidden culinary gems, from century-old Gudeg stalls to modern 
                    fusion cafes in the heart of Java. From the royal kitchens of the Kraton to the
                    bustling night markets of Malioboro, discover the soul of Javanese heritage.
                </p>
            </div>

            <div class="hero-image"></div>
        </section>

        <!-- Category -->
        <div class="row mt-4">

            <div class="col-md-3">
                <div class="sidebar">
                    <h6>Category</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">Snacks</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">Main Course</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">Drinks</label>
                    </div>

                    <h6 class="mt-4">Price Range</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price">
                        <label class="form-check-label">Budget (0-40K)</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price">
                        <label class="form-check-label">Mid-Range (40K-80K)</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="price">
                        <label class="form-check-label">Fine Dining (80K+)</label>
                    </div>

                    <h6 class="mt-4">Min. Rating</h6>
                    <select class="form-select rating-select">
                        <option>5.0 Stars</option>
                        <option>4.5+ Stars</option>
                        <option>4.0+ Stars</option>
                    </select>

                    <div class="map-box">
                        <div class="map-area">
                            REGIONAL MAP
                        </div>
                        <p class="view-map">VIEW FULL MAP</p>
                    </div>
                </div>
            </div>

        <!-- Food -->
            <div class="col-md-9">
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="food-card">
                            <img src="img/gudeg.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Gudeg Yu Djum</h5>
                                    <span class="rating-box">★ 4.8</span>
                                </div>
                                <p class="price">Rp. 25.000–50.000</p>
                                <p class="location">📍 Jl. Wijilan No.167, Kraton</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="food-card">
                            <img src="img/kopi.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Kopi Jos Lik Man</h5>
                                    <span class="rating-box">★ 4.7</span>
                                </div>
                                <p class="price">Rp. 5.000–20.000</p>
                                <p class="location">📍 Wirobrajan, Gedong Tengen</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="food-card">
                            <img src="img/sate.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Sate Klatak Pak Bari</h5>
                                    <span class="rating-box">★ 4.8</span>
                                </div>
                                <p class="price">Rp. 25.000–50.000</p>
                                <p class="location">📍 Pasar Wonokromo, Bantul</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="food-card">
                            <img src="img/bakpia.jpg" class="food-img">
                            <div class="food-content">
                                <div class="title-rating">
                                    <h5>Bakpia Pathok 25</h5>
                                    <span class="rating-box">★ 4.6</span>
                                </div>
                                <p class="price">Rp. 30.000–60.000</p>
                                <p class="location">📍 Suryodiningratan NS4, Pathok</p>
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