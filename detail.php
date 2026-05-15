<?php
session_start();
include 'koneksi.php';

$id = (int) ($_GET['id_kuliner'] ?? 0);
$query = mysqli_query($koneksi, "
    SELECT k.*, kat.nama_kategori, u.username
    FROM kuliner k
    JOIN kategori kat ON k.kategori_id = kat.id_kategori
    JOIN users u ON k.user_id = u.id
    WHERE k.id_kuliner = $id
");

if (mysqli_num_rows($query) == 0) {
    header("location: index.php");
    exit;
}

$k = mysqli_fetch_assoc($query);
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
    <title>Detail</title>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="container py-5">
        <a href="explore.php" class="btn btn-secondary mb-4">← Back</a>
        <div class="row g-5">
            <div class="col-md-7">
                <img src="upload/<?= $k['gambar']; ?>" class="detail-img">
            </div>
            <div class="col-md-5">
                <span class="badge bg-dark">
                    <?= $k['nama_kategori']; ?>
                </span>
                <h2 class="mt-2"><?= $k['nama_tempat']; ?></h2>
                <p><i class="bi bi-geo-alt"></i> <?= $k['lokasi']; ?></p>
                <p><?= $k['deskripsi']; ?></p>
                <small>Dibuat oleh <b><?= $k['username']; ?></b></small>
                <?php if (!empty($k['maps'])) { ?>
                    <div class="mt-3">
                        <a href="<?= $k['maps']; ?>" target="_blank" class="btn btn-warning">
                            Google Maps
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Lokasi Gmaps -->
    <?php if (!empty($k['maps'])): ?>
        <div class="ms-5 me-5 mb-5">
            <h5 class="fw-bold mb-3">Lokasi di Peta</h5>
            <div class="rounded-4 overflow-hidden shadow">
                <iframe
                    src="https://maps.google.com/maps?q=<?= urlencode($k['nama_tempat'].' '.$k['lokasi']) ?>&output=embed"
                    width="100%" height="350" class="maps-embed" allowfullscreen loading="lazy">
                </iframe>
            </div>
        </div>
    <?php endif ?>
    
    <?php include 'footer.php'; ?>

</body>
</html>