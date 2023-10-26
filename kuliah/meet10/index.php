<?php
$valid_username = "admin"; 
$valid_password = "admin"; 
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$login_error = "";
session_start();

if (isset($_POST['login'])) {
    if ($username === $valid_username && $password === $valid_password) {
        header("Location: ./menu/menu.php");
        exit();
    } else {
        $login_error = "Invalid username or password.";
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
