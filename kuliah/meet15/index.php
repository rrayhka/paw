<?php
    require_once 'koneksi.php';
    // if(!isset($_SESSION['login'])) {
    //     header('Location: index.php');
    //     exit();
    // } else{
    //     $username = $_SESSION['username'];
    //     $role = $_SESSION['role'];
    //     if ($role === 'admin') {
    //         header('Location: menu/admin.php');
    //     } else {
    //         header('Location: menu/kasir.php');
    //     }
    // }
    $user = [
        "admin" => [
            "ahmad" => "ahmad123",
            "budi" => "budi123",
            "cindy" => "cindy123",
        ],
        "kasir" => [
            "joko" => "joko123",
            "siti" => "siti123",
            "wati" => "wati123",
        ]
    ];
    $login_error = '';
    $_SESSION["role"] = "Guest";
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; 
        $status = '';
        $loggedIn = false; 

        foreach ($user as $role => $users) {
            if (isset($users[$username]) && $users[$username] === $password) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['login'] = true;
                // $status = $_SESSION['role'];
                
                if ($role === 'admin') {
                    header('Location: menu/menu.php');
                } else {
                    header('Location: menu/menu.php');
                }
                exit(); 
            } else{
                $login_error = 'Username or Password is wrong';
            }
        }
    }
    // var_dump($_SESSION['login']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="post" action="index.php">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required placeholder="Masukkan username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required placeholder="Masukkan Password">
                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                        <?php if (!empty($login_error)): ?>
                            <div class="alert alert-danger mt-3"><?= $login_error ?></div>
                        <?php endif; ?>
                        <p class="mt-3">
                            Login as guest: <a href="orders/addOrder.php">Click here</a>
                        </p>
                        <p class="mt-3">
                            This source code is available on my GitHub account. 
                            <a href="https://github.com/rrayhka/paw" target="_blank">Click here to see it</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
