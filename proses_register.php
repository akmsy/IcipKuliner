<?php
    session_start();
    include 'koneksi.php';

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    if (empty($email) || empty($username) || empty($password_input)) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        header("location: register.php");
        exit();
    }

    // cek email
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['error'] = "Email sudah terdaftar!";
        header("location: register.php");
        exit();
    }

    $password = password_hash($password_input, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username','$password')";
    $result = mysqli_query($koneksi, $query);

    if($result){
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        header('location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Register Gagal!';
        header('location: register.php');
        exit();
    }
?>