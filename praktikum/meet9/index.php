<?php
    require_once("koneksi.php");
    session_start();
    if(isset($_POST["submit"])){
        $query = mysqli_query($koneksi, 
            "SELECT * FROM user"
        ), MYSQLI_ASSOC();
        var_dump($query["level"]);
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
            <label for="username">Username</label>
            <input type="text" name="username"><br>
            <label for="password">Password</label>
            <input type="text" name="password"><br>
            <button type="submit" name="submit">Submit</button>
            <a href="sigunp.php">Sign Up</a>
        </form>
    </body>
</html>