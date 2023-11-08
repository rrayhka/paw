<?php
    include "../koneksi.php";
    $order_id = $_GET['order_id'];
    $query = mysqli_query($conn, "SELECT * FROM order_detail WHERE order_id = $order_id");
    $nomor = 1;
    
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
        $query = mysqli_query($conn, "INSERT INTO `order_detail` VALUES (NULL, '$order_id', '$menu_id', '$qty', '$harga', '$subTotal')");
        if($query){
            echo "<script>
            alert('Data berhasil Ditambahkan!');
            window.location.href = '../orderdetail/admin.php';
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="../orderdetail/admin.php">Order Detail</a>
                    </li>
                    <li class="nav-item">
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
        <a href="admin.php" class="btn btn-primary mb-3">Kembali ke Admin</a>
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
            <thead>
                <th>Nomor</th>
                <th>Order id</th>
                <th>Menu id</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>SubTotal</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php
                    $query = mysqli_query($conn, "SELECT * FROM order_detail WHERE order_id = $order_id");
                    while($data = mysqli_fetch_assoc($query)){ 
                ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data['order_id']; ?></td>
                    <td><?php echo $data['menu_id']; ?></td>
                    <td><?php echo $data['jumlah']; ?></td>
                    <td><?php echo $data['harga']; ?></td>
                    <td><?php echo $data['sub_total']; ?></td>
                    <td>
                        <a class="btn btn-danger" onclick="hapus(<?php echo $data['order_detail_id']; ?>)">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" class="text-center">
                        Total Pembayaran
                    </td>
                    <td colspan="2">
                        <?php
                            $query = mysqli_query($conn, "SELECT SUM(sub_total) AS total FROM order_detail WHERE order_id = $order_id");
                            $data = mysqli_fetch_assoc($query);
                            echo $data['total'];
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        function hapus(orderDetailId){
            if(confirm('Apakah Anda yakin ingin menghapus data ini?')){
                window.location.href = `deleteOrderDetail.php?order_detail_id=${orderDetailId}`;
            }
        }
    </script>
</body>
</html>