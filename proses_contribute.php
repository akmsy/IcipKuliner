<?php 
    session_start(); 
    include 'koneksi.php';

    $place = $_POST['place']; 
    $description = $_POST['description']; 
    $category = $_POST['category'];
    $province = $_POST['province']; 
    $city = $_POST['city']; 
    $district = $_POST['district']; 
    $user_id = $_SESSION['id']; 
    $image = $_FILES['image']['name']; 
    $review = $_POST['review'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "upload/" . $image);

    $query = "INSERT INTO contributions ( place, category, province, city, district, 
    image, review, user_id ) VALUES ( '$place', '$category', '$province', '$city',
    '$district', '$image', '$review', '$user_id' )"; 
    $result = mysqli_query($koneksi, $query); 
    
    if($result){ 
    header("location: contribute.php"); 
    } else { 
    echo "Contribution gagal"; } 
?>