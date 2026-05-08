<?php
    session_start();
    if(!isset($_SESSION['logged_in'])){
        header("location: login.php");
        exit();
    }

    $page = isset($_GET['page'])? $_GET['page']: 1;
    $limit = 2;
    $start = ($page - 1) * $limit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
            <p class="small-orange">CONTRIBUTOR DASHBOARD</p>
            <h1>Your Contributions</h1>
            <p class="header-desc">
                Manage and curate regional culinary heritage spots you've shared
                with the community.
            </p>
        </div>
        
        <div class="header-right">
            <a href="#form-contribute" class="add-btn">Tambah Rekomendasi Baru</a>
        </div>
    </section>

    <!-- Stats -->
    <section class="stats-section">

        <div class="stats-card">
            <p class="stats-title">Total Spots</p>
            <h2>24</h2>
        </div>
        
        <div class="stats-card">
            <p class="stats-title">Published</p>
            <div class="live-row">
                <h2 class="green-number">18</h2>
                <span class="live-badge">LIVE</span>
            </div>
        </div>
        
        <div class="stats-card">
            <p class="stats-title">Pending Review</p>
            <h2 class="orange-number">6</h2>
        </div>

        <div class="stats-card">
            <p class="stats-title">Total Views</p>
            <h2>12.4k</h2>
        </div>
    </section>

    <!-- Table -->
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM contributions LIMIT $start, $limit");
    $query_total = mysqli_query($koneksi,"SELECT * FROM contributions");
    $total_data = mysqli_num_rows($query_total);
    $total_query = mysqli_query($koneksi,"SELECT * FROM contributions");
    $total_data = mysqli_num_rows($total_query);
    $total_page = ceil($total_data / $limit);
    ?>
 
    <section class="table-section">

        <div class="table-header">
            <p>NAME OF SPOT</p>
            <p>LOCATION</p>
            <p>CATEGORY</p>
            <p>STATUS</p>
            <p>ACTIONS</p>
        </div>

        <?php while($data = mysqli_fetch_assoc($query)){?>

        <div class="table-row">

            <div class="spot-info">
                <img src="upload/<?php echo $data['image']; ?>" class="spot-img">
                <div>
                    <h5><?php echo $data['place']; ?></h5>
                    <p><?php echo $data['description']; ?></p>
                </div>
            </div>
            
            <div class="location-text">
                <?php echo $data['province']; ?>,
                <?php echo $data['city']; ?>
            </div>
            
            <div>
                <span class="category-badge"><?php echo $data['category']; ?></span>
            </div>

            <div class="<?php
                if($data['status'] == 'Published'){
                    echo 'status-green';
                } else {
                    echo 'status-orange';
                }
                ?>">
                ● <?php echo $data['status']; ?>
            </div>
        </div>
         <?php } ?>

        <!-- Page -->
        <div class="table-page">
            <p>Showing <?php echo $total_data; ?> contributions</p>

            <div class="pagination-box">
                <?php if($page > 1){ ?>
                <a href="?page=<?php echo $page - 1; ?>"class="page-btn"><</a>
                <?php } ?>

                <?php if($page < $total_page){ ?>
                <a href="?page=<?php echo $page + 1; ?>"class="page-btn">></a>
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
            <div class="mb-4">
                <label class="form-label custom-label">NAME OF PLACE</label>
                <input
                type="text"
                name="place"
                class="form-control custom-input"
                placeholder="e.g. Warung Nasi Campur Bu Made"
                required>
            </div>
            
            <div class="mb-4">
                <label class="form-label custom-label">DESCRIPTION</label>
                <textarea
                name="description"
                class="form-control custom-textarea"
                placeholder="Ceritakan sejarah dan keunikan menu di tempat ini..." required></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">CATEGORY</label>
                    <select name="category" class="form-select custom-input" required>
                        <option value="" selected disabled>Pilih Kategori</option>
                        <option>Snacks</option>
                        <option>Main Course</option>
                        <option>Drinks</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">PROVINCE</label>
                    <select name="province" class="form-select custom-input" required>
                        <option value="" selected disabled>Pilih Provinsi</option>
                        <option>DI Yogyakarta</option>
                        <option>DKI Jakarta</option>
                        <option>Jawa Barat</option>
                        <option>Jawa Tengah</option>
                        <option>Jawa Timur</option>
                        <option>Banten</option>
                    </select>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">REGENCY / CITY</label>
                    <input
                    type="text"
                    name="city"
                    class="form-control custom-input"
                    placeholder="e.g. Jakarta Selatan"
                    required>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label custom-label">VILLAGE / DISTRICT</label>
                    <input
                    type="text"
                    name="district"
                    class="form-control custom-input"
                    placeholder="e.g. Kebayoran Baru"
                    required>
                </div>
            </div>
                <div class="upload-box">
                <label for="image-upload" class="upload-content">
                    <h5>Klik untuk mengunggah atau seret foto</h5>
                    <p>Format JPG, PNG Max. 5MB. Rekomendasi aspek rasio 4:3</p>

                    <input
                    type="file"
                    id="image-upload"
                    name="image"
                    hidden>
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
</html>