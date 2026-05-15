<?php
include 'koneksi.php';

$id_kabupaten = $_POST['id_kabupaten'];

$query = mysqli_query($koneksi,
    "SELECT id_kecamatan, nama_kecamatan 
     FROM kecamatan 
     WHERE kabupaten_id = '$id_kabupaten'"
);

echo '<option value="">Pilih Kecamatan</option>';

while($data = mysqli_fetch_array($query)){

    echo '<option value="'.$data['id_kecamatan'].'">
            '.$data['nama_kecamatan'].'
          </option>';
}
?>