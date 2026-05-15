<?php
    session_start();
    include 'koneksi.php';
    if(!isset($_SESSION['logged_in'])){
        header("location: login.php");
        exit();
    }

    $page = isset($_GET['page'])? $_GET['page']: 1;
    $limit = 5;
    $start = ($page - 1) * $limit;
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
    <title>Contribute</title>
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <!-- Main -->
    <main class="dashboard-container">

    <!--Header-->
    <section class="top-header">
        <div class="header-left">
            <p class="small-orange">DASHBOARD KONTRIBUTOR</p>
            <h1>Kontribusi Anda</h1>
            <p class="header-desc">
                Kelola dan atur rekomendasi kuliner daerah yang telah kamu bagikan kepada komunitas.
            </p>
        </div>
        
        <div class="header-right">
            <a href="#form-contribute" class="add-btn" style="text-decoration: none;"><i class="bi bi-patch-plus-fill"></i> Tambah Rekomendasi Baru</a>
        </div>
    </section>

    <!-- Table -->
    <?php
        $limit = 5;
        $start = ($page - 1) * $limit;

        $query = mysqli_query($koneksi, "SELECT 
            k.*,
            kat.nama_kategori,
            COALESCE(AVG(u.rating), 0) AS avg_rating,
            COUNT(u.id_ulasan) AS total_ulasan
        FROM kuliner k
        JOIN kategori kat 
            ON k.kategori_id = kat.id_kategori
        LEFT JOIN ulasan u 
            ON k.id_kuliner = u.kuliner_id
        GROUP BY k.id_kuliner
        LIMIT $start, $limit");

        // Total data
        $total_query = mysqli_query($koneksi, "
            SELECT COUNT(*) as total 
            FROM kuliner
        ");

        $total_data = mysqli_fetch_assoc($total_query)['total'];

        // Total halaman
        $total_page = ceil($total_data / $limit);
    ?>
 
    <section class="table-section">

        <div class="table-header">
            <p>NAMA TEMPAT</p>
            <p>LOKASI</p>
            <p>KATEGORI</p>
            <p>ULASAN</p>
            <p>AKSI</p>
        </div>

        <?php while($data = mysqli_fetch_assoc($query)){?>

        <div class="table-row">

            <div class="spot-info">
                <img src="upload/<?= $data['gambar']; ?>" class="spot-img">
                <div>
                    <h5><?= $data['nama_tempat']; ?></h5>
                </div>
            </div>
            
            <div class="location-text">
                <?= $data['lokasi']; ?>,
            </div>
            
            <div>
                <span class="category-badge">
                    <?= $data['nama_kategori']; ?></span>
            </div>

            <div class="review_text">
                ⭐ <?= number_format($data['avg_rating'],1); ?>
                (<?= $data['total_ulasan']; ?> ulasan)
            </div>

            <div>
                <a href="edit.php?id=<?= $data['id_kuliner'];?>" class="btn btn-success">Edit</a>
                <a href="hapus.php?id=<?= $data['id_kuliner']; ?>" class="btn btn-warning" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </div>
        </div>
         <?php } ?>

        <!-- Page -->
        <div class="table-page">
            <p>Menampilkan <?= $total_data; ?> tempat kuliner</p>

            <div class="pagination-box">
                <?php if($page > 1){ ?>
                    <a href="?page=<?= $page - 1; ?>" class="page-btn <?= ($page > 1) ? 'active' : ''; ?>">
                        <
                    </a>
                <?php } ?>

                <?php if($page < $total_page){ ?>
                    <a href="?page=<?= $page + 1; ?>" class="page-btn <?= ($page < $total_page) ? 'active' : ''; ?>">
                        >
                    </a>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Form -->
<section class="main-container">
    <section class="title-section text-center">
        <h1>Formulir Rekomendasi</h1>
        <p>Daftarkan pusaka kuliner lokal ke dalam editorial kami.</p>
    </section>

    <section class="form-card" id="form-contribute">
        <form action="proses_contribute.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">NAMA TEMPAT</label>
                    <input
                    type="text"
                    name="place"
                    class="form-control custom-input"
                    placeholder="e.g. Warung Nasi Campur Bu Made"
                    required>
                </div>
            
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">KATEGORI</label>
                    <select name="kategori" class="form-select custom-input" required>
                        <option value="" selected disabled>Pilih Kategori</option>
                        <?php
                            $kategoriQuery = mysqli_query($koneksi,"
                                SELECT *
                                FROM kategori
                            ");

                            while($kat = mysqli_fetch_assoc($kategoriQuery)){
                        ?>
                        <option value="<?= $kat['id_kategori']; ?>">
                            <?= $kat['nama_kategori']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">DETAIL ALAMAT</label>
                    <input
                    type="text"
                    name="detail_alamat"
                    class="form-control custom-input"
                    placeholder="Contoh: Jl. Malioboro No 10"
                    required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">KABUPATEN</label>
                    <select id="kabupaten" name="kabupaten" class="form-select custom-input" required>
                        <option value="" selected disabled>Pilih Kabupaten</option>
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
            </div>
    
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">KECAMATAN</label>
                    <select id="kecamatan" name="kecamatan" class="form-select custom-input" required>
                        <option value="" selected disabled>Pilih Kecamatan</option>
                    </select>
                    
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">DESA</label>
                    <select id="desa" name="desa" class="form-select custom-input" required>
                        <option value="" selected disabled>Pilih Desa</option>
                    </select>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">
                        JAM OPERASIONAL
                    </label>
                    <input
                    type="text"
                    name="jam_operasional"
                    class="form-control custom-input"
                    placeholder="Contoh: 08.00 - 22.00"
                    required>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">
                        HARGA
                    </label>
                    <input
                    type="text"
                    name="harga"
                    class="form-control custom-input"
                    placeholder="Contoh: Rp15.000 - Rp50.000"
                    required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label custom-label">
                    LINK GOOGLE MAPS
                </label>
                <input
                type="url"
                name="maps"
                class="form-control custom-input"
                placeholder="https://maps.google.com/..."
                required>
            </div>

            <div class="mb-4">
                <label class="form-label custom-label">
                    RATING
                </label>
                <select
                name="rating"
                class="form-select custom-input"
                required>
                    <option value="" selected disabled>
                        Pilih Rating
                    </option>
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐⭐</option>
                    <option value="3">3 ⭐⭐⭐</option>
                    <option value="4">4 ⭐⭐⭐⭐</option>
                    <option value="5">5 ⭐⭐⭐⭐⭐</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label custom-label">
                    ULASAN
                </label>
                <textarea
                name="review"
                class="form-control custom-textarea"
                placeholder="Bagikan pengalamanmu..."
                required></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label custom-label" for="image-upload">FOTO TEMPAT</label>
                <div class="upload-box">
                    <label for="image-upload" class="upload-content">
                        <h5>Klik untuk mengunggah atau seret foto</h5>
                        <p>Format JPG, PNG Max. 5MB. Rekomendasi aspek rasio 4:3</p>

                        <input
                        type="file"
                        id="image-upload"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                        hidden>
                    </label>
                </div>
            </div>
            
            <div class="button-section">
                <button type="button" class="cancel-btn">
                    Batalkan
                </button>

                <button type="submit" class="submit-btn">
                    Simpan Kontribusi
                </button>
            </div>
        </form>

    </section>

</main>

  <!-- Footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="script.js"></script>

</html>