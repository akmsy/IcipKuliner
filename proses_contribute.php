<?php 
    session_start(); 
    include 'koneksi.php';

    $place = $_POST['place']; 
    $description = $_POST['description']; 
    $category = $_POST['category'];
    $province = $_POST['province']; 
    $city = $_POST['city']; 
    $district = $_POST['district']; 
    $status = "In Review"; 
    $user_id = $_SESSION['id']; 
    $image = $_FILES['image']['name']; 
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "upload/" . $image);

    $query = "INSERT INTO contributions ( place, description, category, province, city, district, 
    image, status, user_id ) VALUES ( '$place', '$description', '$category', '$province', '$city',
    '$district', '$image', '$status', '$user_id' )"; 
    $result = mysqli_query($koneksi, $query); 
    
    if($result){ 
    header("location: contribute.php"); 
    } else { 
    echo "Contribution gagal"; } 
?>