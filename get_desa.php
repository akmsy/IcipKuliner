<?php
include 'koneksi.php';

$id_kecamatan = $_POST['id_kecamatan'];

$query = mysqli_query($koneksi,
    "SELECT id_desa, nama_desa FROM desa WHERE kecamatan_id = '$id_kecamatan'"
);

echo '<option value="">Pilih Desa</option>';

while($data = mysqli_fetch_array($query)){

    echo '<option value="'.$data['id_desa'].'">
            '.$data['nama_desa'].'
          </option>';
}
?>