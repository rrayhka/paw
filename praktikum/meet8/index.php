<?php
    require_once("koneksi.php");
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();
    $level = $user['level'];
    if($level == 1){
        $level = "Admin";
    }else{
        $level = "User Biasa";
    }
    $nama = $user['nama'];
    $alamat = $user['alamat'];
    $hp = $user['hp'];
    $id = $user['id_user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1;}

        .show {display: block;}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Sistem Penjualan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                <?php if ($level == "Admin") : ?>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dataMasterDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data Master
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dataMasterDropdown">
                            <a class="dropdown-item" href="barang.php">Barang</a>
                            <a class="dropdown-item" href="user.php">User</a>
                        </div>
                    </div>
                <?php endif; ?>
                <a class="nav-link" href="#">Transaksi</a>
                <a class="nav-link" href="#">Laporan</a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $nama; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profil.php">Profil</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </ul>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

