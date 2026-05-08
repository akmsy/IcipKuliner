<?php 
    session_start();
    include 'koneksi.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    
    $result = mysqli_query($koneksi,$query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
         $_SESSION['logged_in'] = true;
        header("location: index.php");
    } else {
        $_SESSION['login_error'] = "Email atau password salah";
        header("location: login.php");
    }
?>