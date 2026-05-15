<?php
include 'koneksi.php';

$id_provinsi = $_POST['id_provinsi'];

$query = mysqli_query($koneksi,
    "SELECT id_kabupaten, nama_kabupaten FROM kabupaten WHERE provinsi_id = '$id_provinsi'"
);

echo '<option value="">Pilih Kabupaten</option>';

while($data = mysqli_fetch_array($query)){

    echo '<option value="'.$data['id_kabupaten'].'">
            '.$data['nama_kabupaten'].'
          </option>';
}
?>