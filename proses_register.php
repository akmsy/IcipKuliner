<?php
    session_start();
    include 'koneksi.php';

    $email    = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm  = $_POST['password_confirm'];

    // Validasi input
    if (empty($email) || empty($username) || empty($password)) {
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

    // cek panjang pw
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password minimal 6 karakter.";
        header("location: register.php");
        exit();
    }

    // cek konfirmasi pw
    if ($password !== $confirm) {
        $_SESSION['error'] = "Password dan konfirmasi password tidak cocok.";
        header("location: register.php");
        exit();
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username','$password_hashed')";
    $result = mysqli_query($koneksi, $query);

    if($result){
        header('location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Register Gagal!';
        header('location: register.php');
        exit();
    }
?>