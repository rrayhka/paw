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
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-semibold mb-4 text-center">Login</h1>
        <form method="post" class="space-y-4">
            <div>
                <label for="username" class="block">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label for="password" class="block">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Login
            </button>
        </form>
    </div>
</body>
</html>
