<?php
    $nomorMeja = isset($_GET["nomor_meja"]) ? $_GET["nomor_meja"] : 0;
    session_start();
    include "../koneksi.php";
    date_default_timezone_set('Asia/Jakarta');
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');
    $query_last_transaction = mysqli_query($conn, "SELECT tanggal_order, jam_order FROM `orders` WHERE nomor_meja = '$nomorMeja' ORDER BY order_id DESC LIMIT 1");
    $last_transaction = mysqli_fetch_assoc($query_last_transaction);
    $last_transaction_time = ($last_transaction && isset($last_transaction["jam_order"])) ? strtotime($last_transaction["jam_order"]) : 0;
    $current_time = strtotime($currentTime);
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
        $nomorMeja = $_POST["nomor_meja"];
        $pelayan = $_POST["nama_pelayan"];
        $qty = $_POST["qty"];
        $no = $_POST["nomor_meja"];
        $menu = $_POST["makanan"];
        $total = $_POST["total"];
        $menu_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT menu_id FROM menu WHERE nama_menu = '$menu'"))["menu_id"];
        $status = "Menunggu";
        $harga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM menu WHERE nama_menu = '$menu'"))["harga"];
        var_dump($nomorMeja);
        if ($last_transaction){
            $time_difference = $current_time - $last_transaction_time;
            if ($time_difference < 600) {
                $remaining_time = 600 - $time_difference;
                $remaining_minutes = ceil($remaining_time / 60);
                
                echo "<script>
                        alert('Meja masih dalam proses pemesanan! Silahkan tunggu hingga $remaining_minutes menit.');
                    </script>";
            } else{
                $query = "INSERT INTO `orders` VALUES (NULL, '$currentDate', '$currentTime', '$pelayan', '$nomorMeja', '$total')";
                mysqli_query($conn, $query);

                if($query) {
                    $orders_id = mysqli_insert_id($conn);
                    $subTotal = $qty * $harga;
                    $query = "INSERT INTO `order_detail` VALUES (NULL, '$orders_id', '$menu_id', '$qty', '$harga', '$subTotal', '$status')";
                    mysqli_query($conn, $query);
                    echo "<script>
                        alert('Data berhasil Ditambahkan!');
                        window.location.href = 'order.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('Data gagal Ditambahkan!');
                    </script>";
                }
            } 
        }else{
            $query = "INSERT INTO `orders` VALUES (NULL, '$currentDate', '$currentTime', '$pelayan', '$nomorMeja', '$total')";
            mysqli_query($conn, $query);

            if($query) {
                $orders_id = mysqli_insert_id($conn);
                $subTotal = $qty * $harga;
                $query = "INSERT INTO `order_detail` VALUES (NULL, '$orders_id', '$menu_id', '$qty', '$harga', '$subTotal', '$status')";
                mysqli_query($conn, $query);
                echo "<script>
                    alert('Data berhasil Ditambahkan!');
                    window.location.href = 'order.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal Ditambahkan!');
                </script>";
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Warungku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="../orders/order.php">Order</a>
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
        <h1 class="mb-4">Tambah Order</h1>
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
                <div class="mt-4">
                        <label for="jam">Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control" value="<?= $currentTime; ?>" readonly>
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
                                <option value="Ucok">Ucok</option>
                                <option value="Dika">Dika</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="nama">Nama Pembeli</label>
                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Masukkan nama Pembeli" required>
                    </div>
                    <div class="mt-4">
                        <label for="nomor_meja">Nomor Meja</label>
                        <input type="number" name="nomor_meja" id="nomor_meja" class="form-control" value="<?= $nomorMeja ?>">
                    </div>
                    <div class="mt-4">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Masukkan jumlah" required>
                    </div>
                    <div class="mt-4">
                        <label for="total">Total Harga</label>
                        <input type="number" name="total" id="total" class="form-control" readonly onchange="total(harga, qty)">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit" name="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var harga = document.getElementById("harga");
        var qty = document.getElementById("qty");
        var total = document.getElementById("total");
        harga.addEventListener("input", updateTotal);
        qty.addEventListener("input", updateTotal);

        function updateTotal() {
            var hargaValue = parseInt(harga.value) || 0;
            var qtyValue = parseInt(qty.value) || 0;
            var result = hargaValue * qtyValue;
            total.value = result;
        }
    </script>
</body>
</html>