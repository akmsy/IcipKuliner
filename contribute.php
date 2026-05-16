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
        $user_id = $_SESSION['id'];
        $query = mysqli_query($koneksi, "SELECT 
            k.*,
            kat.nama_kategori,
            COALESCE(AVG(u.rating), 0) AS avg_rating,
            COUNT(u.id_ulasan) AS total_ulasan,
            u.komentar,
            u.rating,
            k.maps
        FROM kuliner k
        JOIN kategori kat 
            ON k.kategori_id = kat.id_kategori
        LEFT JOIN ulasan u 
            ON k.id_kuliner = u.kuliner_id
        WHERE k.user_id = '$user_id'
        GROUP BY k.id_kuliner
        LIMIT $start, $limit");

        // Total data
        $total_query = mysqli_query($koneksi, "
            SELECT COUNT(*) as total 
            FROM kuliner
            WHERE user_id = '$user_id'
        ");

        $total_data = mysqli_fetch_assoc($total_query)['total'];

        // Total halaman
        $total_page = ceil($total_data / $limit);
    ?>
 
    <section class="table-section mt-5">
        <div class="table-header">
            <span>NAMA TEMPAT</span>
            <span>LOKASI</span>
            <span>KATEGORI</span>
            <span>ULASAN</span>
            <span>AKSI</span>
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

            <div class="action-cell">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id_kuliner']; ?>">Edit</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $data['id_kuliner']; ?>">Hapus</button>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal<?= $data['id_kuliner']; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data Kuliner</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $data['id_kuliner']; ?>">
                                <div class="mb-3">
                                    <label>Nama Tempat</label>
                                    <input type="text" class="form-control" name="nama_tempat" value="<?= $data['nama_tempat']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-select"> <?php
                                        $kategoriEdit = mysqli_query(
                                            $koneksi,
                                            "SELECT * FROM kategori"
                                        );
                    
                                        while($kat=mysqli_fetch_assoc($kategoriEdit)){
                                        ?>
                    
                                        <option value="<?= $kat['id_kategori']; ?>" <?=($kat['id_kategori']==$data['kategori_id'])?'selected':'';?>>
                                            <?= $kat['nama_kategori']; ?>
                                        </option>
                    
                                        <?php } ?>
                                    </select>
                    
                                </div>

                                <div class="mb-3">
                                    <label>Detail Alamat</label>
                                    <input type="text" class="form-control" name="detail_alamat" required>
                                </div>

                                <div class="mb-3">
                                    <label>Kabupaten</label>
                                    <select class="form-select" name="kabupaten" required>
                                        <?php
                                        $kabupaten = mysqli_query(
                                            $koneksi,
                                            "SELECT * FROM kabupaten"
                                        );
                                        while($kab = mysqli_fetch_assoc($kabupaten)){
                                        ?>
                                        <option value="<?= $kab['id_kabupaten']; ?>">
                                            <?= $kab['nama_kabupaten']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                 <div class="mb-3">
                                    <label>Kecamatan</label>
                                    <select class="form-select" name="kecamatan" required>
                                        <option>Pilih Kecamatan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Desa</label>
                                    <select class="form-select" name="desa" required>
                                        <option>Pilih Desa</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Jam Operasional</label>
                                    <input type="text" class="form-control" name="jam_operasional" value="<?= $data['jam_operasional']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Harga</label>
                                        <input type="text" class="form-control" name="harga" value="<?= $data['harga']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Google Maps</label>
                                    <input type="text" class="form-control" name="maps" value="<?= $data['maps']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Rating</label>
                                    <select class="form-select" name="rating" required>
                                        <option value="<?=($data['rating']==1)?'selected':'';?>"><?=($data['rating']==1)?'selected':'';?></option>
                                        <option value="1">1 ⭐</option>
                                        <option value="2">2 ⭐⭐</option>
                                        <option value="3">3 ⭐⭐⭐</option>
                                        <option value="4">4 ⭐⭐⭐⭐</option>
                                        <option value="5">5 ⭐⭐⭐⭐⭐</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Review</label>
                                    <textarea class="form-control" name="review" rows="4" required><?= $data['komentar']; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Gambar Baru</label>
                                    <input type="file" class="form-control" name="gambar">
                                    <small>Kosongkan jika tidak ingin mengganti gambar</small>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal Hapus -->
            <div class="modal fade"
                id="hapusModal<?= $data['id_kuliner']; ?>"
                tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>
                        </div>

                        <div class="modal-body">Yakin ingin menghapus <b><?= $data['nama_tempat']; ?></b> ?
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="proses_hapus.php?id_kuliner=<?= $data['id_kuliner']; ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
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
            <form action="proses_contribute.php" method="POST" enctype="multipart/form-data" class="align-center">
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