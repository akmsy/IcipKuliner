<?php
include 'koneksi.php';

$id_provinsi = $_POST['id_provinsi'];

$query = mysqli_query($koneksi,
    "SELECT id, name FROM reg_regencies WHERE province_id = '$id_provinsi'"
);

echo '<option value="">Pilih Kabupaten</option>';

while($data = mysqli_fetch_array($query)){

    echo '<option value="'.$data['id'].'">
            '.$data['name'].'
          </option>';
}
?>