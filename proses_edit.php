<?php
    session_start();
    include 'koneksi.php';

    $id_kuliner = $_POST['id'];

    $nama_tempat = $_POST['nama_tempat'];
    $kategori_id = $_POST['kategori'];
    $lokasi = $_POST['lokasi'];
    $jam_operasional = $_POST['jam_operasional'];
    $harga = $_POST['harga'];
    $maps = $_POST['maps'];
    $rating = $_POST['rating'];
    $komentar = $_POST['review'];

    // ambil gambar lama
    $query = mysqli_query(
        $koneksi,
        "SELECT gambar
        FROM kuliner
        WHERE id_kuliner='$id_kuliner'"
    );

    $data = mysqli_fetch_assoc($query);

    $gambar = $data['gambar'];

    // upload gambar jika ada
    if($_FILES['gambar']['name'] != ""){

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file(
            $tmp,
            'upload/'.$gambar
        );
    }


    // update kuliner
    $queryKuliner = mysqli_query(
        $koneksi,

        "UPDATE kuliner
        SET
            nama_tempat='$nama_tempat',
            lokasi='$lokasi',
            jam_operasional='$jam_operasional',
            harga='$harga',
            maps='$maps',
            gambar='$gambar',
            kategori_id='$kategori_id'

        WHERE id_kuliner='$id_kuliner'"
    );


    // update ulasan
    $queryUlasan = mysqli_query(
        $koneksi,

        "UPDATE ulasan
        SET
            komentar='$komentar',
            rating='$rating'

        WHERE kuliner_id='$id_kuliner'"
    );


    if($queryKuliner && $queryUlasan){
        header("Location: contribute.php?edit=success");
        exit;
    }
    else{
        echo "Edit gagal";
    }

?>