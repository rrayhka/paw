<?php
    require_once("koneksi.php");
    session_start();
    if(isset($_SESSION['login'])){
        header("Location: index.php");
    }
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();
        if($user){
            if(password_verify($password, $user['password'])){
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                header("Location: index.php");
            }else{
                echo "Password salah";
            }
        }else{
            echo "Username tidak ditemukan";
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
        <form method="post">
            <label for="username">Masukkan Username</label>
            <input type="text" name="username" required><br>
            <label for="password">Masukkan password</label>
            <input type="password" name="password" required><br>
            <button type="submit" name="submit">Submit</button>
        </form> 
    </body>
</html>