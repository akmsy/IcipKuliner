<?php
    session_start();
    include 'koneksi.php';

    $id_kuliner = $_POST['id'];

    $nama_tempat = $_POST['nama_tempat'];
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

    // ambil nama kabupaten
    $query_kab = mysqli_query(
        $koneksi,
        "SELECT nama_kabupaten
        FROM kabupaten
        WHERE id_kabupaten='$id_kabupaten'"
    );

    $data_kab = mysqli_fetch_assoc($query_kab);

    // ambil nama kecamatan
    $query_kec = mysqli_query(
        $koneksi,
        "SELECT nama_kecamatan
        FROM kecamatan
        WHERE id_kecamatan='$id_kecamatan'"
    );

    $data_kec = mysqli_fetch_assoc($query_kec);

    // ambil nama desa
    $query_desa = mysqli_query(
        $koneksi,
        "SELECT nama_desa
        FROM desa
        WHERE id_desa='$id_desa'"
    );

    $data_desa = mysqli_fetch_assoc($query_desa);

    // gabung lokasi
    $lokasi =
        $detail . ', ' .
        $data_desa['nama_desa'] . ', ' .
        $data_kec['nama_kecamatan'] . ', ' .
        $data_kab['nama_kabupaten'];


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
        header("Location: contribute.php");
        exit;
    }
    else{
        echo "Edit gagal";
    }

?>