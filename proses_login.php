<?php 
    session_start();
    include 'koneksi.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Email dan password wajib diisi.";
        header("location: login.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE email='$email'";
    
    $result = mysqli_query($koneksi,$query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['id']        = $user['id'];
            $_SESSION['email']     = $user['email'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['logged_in'] = true;
            header("location: index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Email atau password salah";
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Email atau password salah";
        header("location: login.php");
        exit();
    }
?>