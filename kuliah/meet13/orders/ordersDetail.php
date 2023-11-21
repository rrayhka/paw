<?php
    include "../koneksi.php";
    $order_id = $_GET['order_id'];
    $query = mysqli_query($conn, "SELECT * FROM order_detail WHERE order_id = $order_id");
    $nomor = 1;
    $status = "Menunggu";
    
    if(isset($_POST["submit"])){
        $menu_id = mysqli_real_escape_string($conn, $_POST["nama_menu"]);
        $qty = mysqli_real_escape_string($conn, $_POST["qty"]);
        $query = "SELECT harga FROM menu WHERE menu_id = $menu_id";
        $result = mysqli_query($conn, $query);
        $subTotal = 0;
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $harga = $row["harga"];
            $subTotal = $qty * $harga;
        } else {
            $subTotal = 0; 
        }
        $query = mysqli_query($conn, "INSERT INTO `order_detail` VALUES (NULL, '$order_id', '$menu_id', '$qty', '$harga', '$subTotal', '$status')");
        if($query){
            $query = mysqli_query($conn, "SELECT SUM(sub_total) AS total FROM order_detail WHERE order_id = $order_id");
            $data = mysqli_fetch_assoc($query);
            $total = $data['total'];
            $query = mysqli_query($conn, "UPDATE orders SET total_bayar = $total WHERE order_id = $order_id");
            echo "<script>
            alert('Data berhasil Ditambahkan!');
            window.reload();
            </script>";
        }
    }
    
    if(isset($_POST["status"])) {
        $detail_order_id = $_POST["detail_order_id"];
        $status1 = $_POST["status"];
        $sql = mysqli_query($conn, "UPDATE order_detail SET status = '$status1' WHERE order_detail_id = $detail_order_id");
        if($sql) {
            echo "<script>
                window.reload();
            </script>";
        } else {
            echo "Gagal mengubah status";
        }
    
    }
?>

<?php
        if(isset($_GET["order_detail_id"]) && isset($_GET["order_id"])){
            $order_detail_id = $_GET["order_detail_id"];
            $order_id = $_GET["order_id"];
            $hapus = mysqli_query($conn, "DELETE FROM order_detail WHERE order_detail_id = $order_detail_id");
            if($hapus){
                $update = mysqli_query($conn, "UPDATE orders SET total_bayar = (SELECT SUM(sub_total) FROM order_detail WHERE order_id = $order_id) WHERE order_id = $order_id");
                header("Location: ordersDetail.php?order_id=$order_id");
                echo "<script>
                    window.reload();
                </script>";
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
        <h2>Detail Order</h2>
        <a href="order.php" class="btn btn-primary mb-3">Kembali ke Order</a>
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <th>Nama Menu</th>
                <th>Qty</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <form method="post">
                    <tr>
                        <td>
                            <select name="nama_menu" id="nama_menu" class="form-control" required style="text-align: center;">
                                <option value="" disabled selected>Pilih Menu</option>
                                <?php
                                    $query_makanan = "SELECT * FROM menu";
                                    $result_makanan = mysqli_query($conn, $query_makanan);
                                    while ($row = mysqli_fetch_assoc($result_makanan)) {
                                        echo "<option value='{$row['menu_id']}'>{$row['nama_menu']}</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="qty" id="qty" class="form-control" required>
                        </td>
                        <td>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
        <table class="table table-striped table-bordered text-center table-hover">
            <thead class="table-primary">
                <th>Nomor</th>
                <th>Order id</th>
                <th>Menu id</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>SubTotal</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php
                    $query = mysqli_query($conn, "SELECT * FROM order_detail WHERE order_id = $order_id");
                    $status = [
                        'Sudah Dilayani',
                        'Belum Dilayani',
                        'Sedang Dilayani',
                        'Selesai'
                    ];
                    while($data = mysqli_fetch_assoc($query)){ 
                ?>
                <tr>
                    <!-- <td><?php echo $data["order_detail_id"] ?></td> -->
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data['order_id']; ?></td>
                    <td><?php echo $data['menu_id']; ?></td>
                    <td><?php echo $data['jumlah']; ?></td>
                    <td><?php echo $data['harga']; ?></td>
                    <td><?php echo number_format($data['sub_total']); ?></td>
                    <td>
                        <form method="post">
                            <?php if($data['status'] !== "Selesai") : ?>
                                <select name="status" id="" onchange="this.form.submit()">
                                    <option value="<?= $data['status'] ?>"><?= $data['status'] ?></option>
                                    <?php foreach($status as $key => $value) : ?>
                                        <option value="<?= $value ?>"><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else : ?>
                                <button class="btn btn-success">Selesai</button>
                            <?php endif ?>
                            <input type="hidden" name="detail_order_id" value="<?php echo $data['order_detail_id']; ?>">
                        </form>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="ordersDetail.php?order_detail_id=<?= $data['order_detail_id']; ?>&order_id=<?= $order_id; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="6" class="text-center">
                        Total Pembayaran
                    </td>
                    <td colspan="2">
                        <?php
                            $query = mysqli_query($conn, "SELECT SUM(sub_total) AS total FROM order_detail WHERE order_id = $order_id");
                            $data = mysqli_fetch_assoc($query);
                            $total = $data['total'];
                            echo " Rp ". number_format($data['total']);
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>