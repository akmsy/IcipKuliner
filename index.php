<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column align-items-start">
            <h6>WARISAN NUSANTARA</h6>
            <h1 class="fw-bold">Cari Kuliner Terdekat di Daerahmu</h1>
            <p>Jelajahi cita rasa warisan Nusantara yang tersembunyi di setiap sudut daerah. Temukan resep keluarga dan hidangan otentik dari segala penjuru daerah.</p>
        </div>
        
        <?php
            $images = [
                "img/kuliner.jpg",
                "img/petakuliner.jpg"
            ];
        ?>

        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            <div class="card-wrapper">

                <?php foreach ($images as $index => $img): ?>
                    <div class="custom-card <?php echo $index === 0 ? 'back' : 'front'; ?>">
                        <img src="<?php echo $img; ?>" alt="Photo">
                    </div>
                <?php endforeach; ?>

                <div class="bubble">
                    "Jiwa suatu daerah terletak pada rempah-rempahnya"
                </div>
                
            </div>
            
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>