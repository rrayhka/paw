<?php
    session_start();
    include "../koneksi.php";
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');
    $currentTimeWIB = date('H:i:s', strtotime('+5 hours', strtotime($currentTime)));
    $jenis_makanan = "Makanan";
    $makanan = "";
    $harga = 0;
    
    if(isset($_POST["jenis_makanan"])) {
        $jenis_makanan = $_POST["jenis_makanan"];
        $_SESSION['jenis_makanan'] = $jenis_makanan;
    }
    
    if(isset($_POST["nama_menu"])) {
        $makanan = $_POST["nama_menu"];  
        $query_harga = "SELECT harga FROM menu WHERE nama_menu = '$makanan'";
        $harga = mysqli_fetch_assoc(mysqli_query($conn, $query_harga))["harga"];
    }

    if(isset($_POST["submit"])) {
        $nama_pembeli = $_POST["nama_pembeli"];
        $pelayan = $_POST["nama_pelayan"];
        $no = $_POST["nomor_meja"];
        $menu = $_POST["makanan"];
        $menu_id = "SELECT menu_id FROM menu WHERE nama_menu = '$menu'";
        $menu_id2 = mysqli_fetch_assoc(mysqli_query($conn, $menu_id))["menu_id"];
        $query_harga2 = "SELECT harga FROM menu WHERE nama_menu = '$menu'";
        $harga2 = mysqli_fetch_assoc(mysqli_query($conn, $query_harga2))["harga"];
        $query = "INSERT INTO `orders` VALUES (NULL, '$menu_id2', '$nama_pembeli', '$menu', $harga2, '$currentDate', '$currentTimeWIB', '$pelayan', '$no')";
        mysqli_query($conn, $query);

        if($query) {
            $orders_id = mysqli_insert_id($conn);
            $query = "INSERT INTO `order_detail` VALUES (NULL, '$orders_id', '$menu_id2')";
            mysqli_query($conn, $query);
            echo "<script>
                alert('Data berhasil Ditambahkan!');
                window.location.href = '../orderdetail/admin.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal Ditambahkan!');
            </script>";
        }
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WarungKU Menu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="../menu/menu.php">WarungKU</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../orderdetail/admin.php">Order Detail</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../orders/addOrder.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../menu/menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/rrayhka" target="_blank">
                            <i class="bi bi-github">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.20-.36-1.02.08-2.12 0 0 .67-.21 2.20.82.64-.18 1.32-.27 2.00-.27.68 0 1.36.09 2.00.27 1.53-1.04 2.20-.82 2.20-.82.44 1.10.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.20 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                </svg>
                            </i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <h1 class="mb-4">Order Pembeli</h1>
        <div class="row">
            <div class="col">
                <div class="mt-4">
                    <form method="post">
                        <div class="form-group">
                            <label for="jenis_makanan">Jenis Makanan</label>
                            <select name="jenis_makanan" id="jenis_makanan" class="form-control" onchange="this.form.submit()" required>
                                <option value="" disabled selected><?= $_SESSION["jenis_makanan"]; ?></option>
                                <?php if($_SESSION["jenis_makanan"] === "Minuman"): ?>
                                    <option value="Makanan">Makanan</option>
                                <?php else: ?>
                                    <option value="Minuman">Minuman</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                    <form method="post">
                        <label for="nama_menu">Nama Makanan</label>
                        <select name="nama_menu" id="nama_menu" class="form-control" onchange="this.form.submit()" required>
                            <option value="" disabled selected><?= $makanan ? $makanan : "Pilih ".$_SESSION["jenis_makanan"]; ?></option>
                            <?php
                                $query_makanan = "SELECT nama_menu FROM menu WHERE kategori = '$_SESSION[jenis_makanan]'";
                                $result_makanan = mysqli_query($conn, $query_makanan);
                                while($row = mysqli_fetch_assoc($result_makanan)){
                                    echo "<option value='{$row['nama_menu']}'>{$row['nama_menu']}</option>";
                                }
                            ?>
                        </select>
                    </form>
                </div>
                <div class="mt-4">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" readonly value="<?= $harga; ?>">
                </div>
                <div class="mt-4">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $currentDate; ?>" readonly>
                </div>
            </div>
            <div class="col">
                <form method="post">
                    <input type="hidden" name="makanan" value="<?= $makanan; ?>"/>
                    <div class="mt-4">
                        <div class="form-group">
                            <label for="nama_pelayan">Nama Pelayan</label>
                            <select name="nama_pelayan" id="nama_pelayan" class="form-control" required>
                                <option value="" disabled selected>Silahkan pilih</option>
                                <option value="Abdul">Abdul</option>
                                <option value="Galih">Galih</option>
                                <option value="Komeng">Ucok</option>
                                <option value="Dika">Dika</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="nama">Nama Pembeli</label>
                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mt-4">
                        <label for="nomor_meja">Nomor Meja</label>
                        <input type="number" name="nomor_meja" id="nomor_meja" class="form-control" placeholder="Masukkan nomor meja" required>
                    <div class="mt-4">
                        <label for="jam">Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control" value="<?= $currentTimeWIB; ?>" readonly>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
