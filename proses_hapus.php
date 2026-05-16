<?php
    include 'koneksi.php';

    $id_kuliner = $_GET['id_kuliner'];

    // ambil gambar
    $query = mysqli_query(
        $koneksi,
        "SELECT gambar
        FROM kuliner
        WHERE id_kuliner='$id_kuliner'"
    );

    $data = mysqli_fetch_assoc($query);

    // hapus gambar dari folder
    if(file_exists('upload/'.$data['gambar'])){
        unlink('upload/'.$data['gambar']);
    }

    // hapus ulasan
    $queryUlasan = mysqli_query(
        $koneksi,
        "DELETE FROM ulasan
        WHERE kuliner_id='$id_kuliner'"
    );

    // hapus kuliner
    $queryKuliner = mysqli_query(
        $koneksi,
        "DELETE FROM kuliner
        WHERE id_kuliner='$id_kuliner'"
    );

    if($queryKuliner){
        header("Location: contribute.php");
        exit;
    }else{
        echo "Gagal menghapus";
    }
?>