<?php
    require_once("koneksi.php");
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            session_start();
            $_SESSION['login'] = $username;
            header("Location: index.php");
        }else{
            echo "Username atau password salah";
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
            <input type="password" name="password" required>
            <button type="submit" name="submit">Submit</button>
        </form> 
    </body>
</html>