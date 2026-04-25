<?php 
    session_start();
    include 'koneksi.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi,"SELECT * FROM users WHERE email='$email' AND password='$password'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        header("location:index.php");
    } else {
        $_SESSION['login_error'] = "Email atau password salah";
        header("location:login.php");
    }
?>