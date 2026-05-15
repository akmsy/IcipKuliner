<?php
    session_start();
    include 'koneksi.php';

    $nama_tempat = $_POST['place'];
    $kategori_id = $_POST['kategori'];
    $detail = $_POST['detail_alamat'];
    $id_kabupaten = $_POST['kabupaten'];
    $id_kecamatan = $_POST['kecamatan'];
    $id_desa = $_POST['desa'];
    $jam_operasional = $_POST['jam_operasional'];
    $harga = $_POST['harga'];
    $maps = $_POST['maps'];
    $rating = $_POST['rating'];
    $komentar = $_POST['review'];

    $user_id = $_SESSION['id'];
    $nama_pengguna = $_SESSION['username'];

    // ambil nama kabupaten
    $query_kab = mysqli_query($koneksi,
        "SELECT nama_kabupaten
        FROM kabupaten
        WHERE id_kabupaten = '$id_kabupaten'"
    );

    $data_kab = mysqli_fetch_assoc($query_kab);

    // ambil nama kecamatan
    $query_kec = mysqli_query($koneksi,
        "SELECT nama_kecamatan
        FROM kecamatan
        WHERE id_kecamatan = '$id_kecamatan'"
    );

    $data_kec = mysqli_fetch_assoc($query_kec);

    // ambil nama desa
    $query_desa = mysqli_query($koneksi,
        "SELECT nama_desa
        FROM desa
        WHERE id_desa = '$id_desa'"
    );

    $data_desa = mysqli_fetch_assoc($query_desa);

    // gabung lokasi
    $lokasi =
        $detail . ', ' .
        $data_desa['nama_desa'] . ', ' .
        $data_kec['nama_kecamatan'] . ', ' .
        $data_kab['nama_kabupaten'];

    // upload gambar
    $gambar = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, 'upload/' . $gambar);

    // insert kuliner
    $queryKuliner = mysqli_query($koneksi,
        "INSERT INTO kuliner
        (
            nama_tempat,
            lokasi,
            jam_operasional,
            harga,
            maps,
            gambar,
            kategori_id,
            user_id
        )

        VALUES
        (
            '$nama_tempat',
            '$lokasi',
            '$jam_operasional',
            '$harga',
            '$maps',
            '$gambar',
            '$kategori_id',
            '$user_id'
        )"
    );

    // ambil id kuliner terakhir
    $id_kuliner = mysqli_insert_id($koneksi);

    // insert ulasan
    $queryUlasan = mysqli_query($koneksi,
        "INSERT INTO ulasan
        (
            nama_pengguna,
            komentar,
            rating,
            kuliner_id
        )

        VALUES
        (
            '$nama_pengguna',
            '$komentar',
            '$rating',
            '$id_kuliner'
        )"
    );

    if($queryKuliner && $queryUlasan){
        header("Location: contribute.php");
        exit;
    }else{
        echo "Contribution gagal";
    }
?>