<?php
    require_once 'koneksi.php';
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
    
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        foreach ($user as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($username == $key2 && $password == $value2) {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $key;
                    $_SESSION['login'] = true;
                    header("Location: home.php");
                }
            }
        }
    }
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
                                <input type="text" class="form-control" name="username" id="username" required placeholder="username = admin">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required placeholder="password = admin">
                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                        <?php if (!empty($login_error)): ?>
                            <div class="alert alert-danger mt-3"><?= $login_error ?></div>
                        <?php endif; ?>
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
