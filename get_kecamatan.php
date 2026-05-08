<?php
include 'koneksi.php';

$id_kabupaten = $_POST['id_kabupaten'];

$query = mysqli_query($koneksi,
    "SELECT id, name 
     FROM reg_districts 
     WHERE regency_id = '$id_kabupaten'"
);

echo '<option value="">Pilih Kecamatan</option>';

while($data = mysqli_fetch_array($query)){

    echo '<option value="'.$data['id'].'">
            '.$data['name'].'
          </option>';
}
?>