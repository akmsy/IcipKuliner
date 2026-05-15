<?php
include 'koneksi.php';

$kabupaten = isset($_GET['kabupaten']) ? $_GET['kabupaten'] : '';
$kecamatan = isset($_GET['kecamatan']) ? $_GET['kecamatan'] : '';
$desa = isset($_GET['desa']) ? $_GET['desa'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$sql = "
    SELECT 
        k.*,
        kat.nama_kategori
    FROM kuliner k
    JOIN kategori kat
    ON k.kategori_id = kat.id_kategori
    WHERE 1=1
";

if($kabupaten != ''){
    $ambilKabupaten = mysqli_query($koneksi,"
        SELECT nama_kabupaten
        FROM kabupaten
        WHERE id_kabupaten = '$kabupaten'
    ");

    $dataKabupaten = mysqli_fetch_assoc($ambilKabupaten);
    $namaKabupaten = $dataKabupaten['nama_kabupaten'];

    $sql .= " AND k.lokasi LIKE '%$namaKabupaten%'";
}

if($kecamatan != ''){
    $ambilKecamatan = mysqli_query($koneksi,"
        SELECT nama_kecamatan
        FROM kecamatan
        WHERE id_kecamatan = '$kecamatan'
    ");

    $dataKecamatan = mysqli_fetch_assoc($ambilKecamatan);
    $namaKecamatan = $dataKecamatan['nama_kecamatan'];

    $sql .= " AND k.lokasi LIKE '%$namaKecamatan%'";
}

if($desa != ''){
    $ambilDesa = mysqli_query($koneksi,"
        SELECT nama_desa
        FROM desa
        WHERE id_desa = '$desa'
    ");

    $dataDesa = mysqli_fetch_assoc($ambilDesa);
    $namaDesa = $dataDesa['nama_desa'];

    $sql .= " AND k.lokasi LIKE '%$namaDesa%'";
}

if($kategori != ''){
    $sql .= " AND k.kategori_id = '$kategori'";
}

$queryKuliner = mysqli_query($koneksi,$sql);
?>

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

<header>
    <?php include 'navbar.php'; ?>
</header>

<main>
    <div class="container-fluid main-container">

        <!-- Hero -->
        <section class="hero-section mb-5">
            <div class="hero-text">
                <p class="orange">REKOMENDASI BERDASARKAN LOKASI SAAT INI</p>
                <h1>Cita Rasa Autentik <span>Yogyakarta</span></h1>
                <p class="hero-desc">
                    Temukan rekomendasi kuliner mulai dari gudeg legendaris hingga cafe modern di Yogyakarta.
                </p>
            </div>

            <div class="hero-image"></div>
        </section>

        <!-- Filter -->
        <form method="GET">
            <div class="filter-box shadow">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="filter-label">KABUPATEN</label>

                        <select id="kabupaten" name="kabupaten" class="form-select custom-select">
                            <option value="">Pilih Kabupaten</option>

                            <?php
                            $kabupatenQuery = mysqli_query($koneksi,"
                                SELECT id_kabupaten,nama_kabupaten
                                FROM kabupaten
                            ");

                            while($data = mysqli_fetch_assoc($kabupatenQuery)){
                            ?>

                            <option value="<?= $data['id_kabupaten']; ?>" <?= ($kabupaten == $data['id_kabupaten']) ? 'selected' : ''; ?>>
                                <?= $data['nama_kabupaten']; ?>
                            </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="filter-label">KECAMATAN</label>

                        <select id="kecamatan" name="kecamatan" class="form-select custom-select">
                            <option value="">Pilih Kecamatan</option>

                            <?php
                            if($kabupaten != ''){

                                $kecamatanQuery = mysqli_query($koneksi,"
                                    SELECT id_kecamatan,nama_kecamatan
                                    FROM kecamatan
                                    WHERE kabupaten_id = '$kabupaten'
                                ");

                                while($kec = mysqli_fetch_assoc($kecamatanQuery)){
                            ?>

                            <option value="<?= $kec['id_kecamatan']; ?>" <?= ($kecamatan == $kec['id_kecamatan']) ? 'selected' : ''; ?>>
                                <?= $kec['nama_kecamatan']; ?>
                            </option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="filter-label">DESA</label>

                        <select id="desa" name="desa" class="form-select custom-select">
                            <option value="">Pilih Desa</option>

                            <?php
                            if($kecamatan != ''){

                                $desaQuery = mysqli_query($koneksi,"
                                    SELECT id_desa,nama_desa
                                    FROM desa
                                    WHERE kecamatan_id = '$kecamatan'
                                ");

                                while($d = mysqli_fetch_assoc($desaQuery)){
                            ?>

                            <option value="<?= $d['id_desa']; ?>" <?= ($desa == $d['id_desa']) ? 'selected' : ''; ?>>
                                <?= $d['nama_desa']; ?>
                            </option>

                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="filter-label">KATEGORI</label>

                        <select name="kategori" class="form-select custom-select">
                            <option value="">Semua Kategori</option>

                            <?php
                            $kategoriQuery = mysqli_query($koneksi,"
                                SELECT *
                                FROM kategori
                            ");

                            while($kat = mysqli_fetch_assoc($kategoriQuery)){
                            ?>

                            <option value="<?= $kat['id_kategori']; ?>" <?= ($kategori == $kat['id_kategori']) ? 'selected' : ''; ?>>
                                <?= $kat['nama_kategori']; ?>
                            </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn search-btn w-100">
                            Cari Kuliner
                        </button>
                    </div>

                </div>
            </div>
        </form>

        <!-- Food -->
        <div class="container py-4 mt-5">
            <div class="row g-4">
                <?php
                if(mysqli_num_rows($queryKuliner) > 0){
                    while($data = mysqli_fetch_assoc($queryKuliner)){
                ?>

                <div class="col-md-4">
                    <div class="food-card h-100">
                        <img src="upload/<?= $data['gambar']; ?>" class="food-img">
                        <div class="food-content d-flex flex-column">
                            <div class="title-rating">
                                <h5><?= $data['nama_tempat']; ?></h5>
                                <span class="rating-box">
                                    <?= $data['nama_kategori']; ?>
                                </span>
                            </div>
                            <p class="price">
                                <?= $data['harga']; ?>
                            </p>
                            <p class="location">
                                <i class="bi bi-geo-alt"></i>
                                <?= $data['lokasi']; ?>
                            </p>
                            <a href="detail.php?id_kuliner=<?= $data['id_kuliner']; ?>" class="btn btn-orange btn-sm rounded-pill mt-auto">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                    }

                } else {
                ?>

                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Data kuliner tidak ditemukan
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>

    </div>
</main>

<footer>
    <?php include 'footer.php'; ?>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="script.js"></script>

</body>
</html>