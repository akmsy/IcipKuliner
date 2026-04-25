<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
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
                </article>

                <figure class="col-md-6 d-flex justify-content-center">
                    <div class="card-wrapper">

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

                        <figcaption class="bubble">
                            "Jiwa suatu daerah terletak pada rempah-rempahnya"
                        </figcaption>

                    </div>
                </figure>

            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>
</html>