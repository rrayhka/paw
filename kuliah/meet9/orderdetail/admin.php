<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kuliah";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Query untuk mengambil data dari tabel orderDetail
$stmt = $conn->query("SELECT * FROM orderDetail");
$orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

    </style>
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
                        <a class="nav-link" href="../order/order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../menu/menu.php">Menu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <h1 class="mb-2">Daftar Pesanan</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nomor Meja</th>
                    <th>Nama Pembeli</th>
                    <th>Jenis Makanan</th>
                    <th>Nama Makanan</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Pelayan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $indeks = 1; ?>
                <?php foreach ($orderDetails as $orderDetail) : ?>
                    <tr>
                        <td><?php echo $indeks; ?></td>
                        <td><?php echo $orderDetail['nomor_meja']; ?></td>
                        <td><?php echo $orderDetail['nama_pembeli']; ?></td>
                        <td><?php echo $orderDetail['jenis_makanan']; ?></td>
                        <td><?php echo $orderDetail['nama_makanan']; ?></td>
                        <td><?php echo $orderDetail['harga']; ?></td>
                        <td><?php echo $orderDetail['tanggal']; ?></td>
                        <td><?php echo $orderDetail['jam']; ?></td>
                        <td><?php echo $orderDetail['nama_pelayan']; ?></td>
                        <td><a href="deleteOrderDetail.php?id=<?php echo $orderDetail['id']; ?>" class="btn btn-danger">Hapus</a></td>
                    </tr>
                    <?php $indeks++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
