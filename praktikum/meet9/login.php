<?php
session_start();
require "koneksi.php";
// if (isset($_SESSION["login"])) {
//     header("Location: index.php");
//     exit;
// }
require "koneksi.php";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        // Verify the password directly without rehashing
        if (md5($password == $row["password"])) {
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }
    } else {
        $error = true;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Halaman Login</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / Password salah</p>
    <?php endif; ?>
    <form method="post">
        <label for="username">Masukkan Username</label>
        <input type="text" name="username"><br>
        <label for="password">Masukkan Password</label>
        <input type="password" name="password"><br>
        <button type="submit" name="login">Submit</button>
    </form>
</body>
</html>
