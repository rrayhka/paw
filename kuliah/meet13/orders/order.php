<?php
include "../koneksi.php";
$data = mysqli_query($conn,"SELECT * FROM orders");

$sort_tgl_desc = mysqli_query($conn, "SELECT * FROM orders ORDER BY tanggal_order DESC");
$sort_tgl_asc = mysqli_query($conn, "SELECT * FROM orders ORDER BY tanggal_order");
$sort_meja_desc = mysqli_query($conn, "SELECT * FROM orders ORDER BY nomor_meja DESC");
$sort_meja_asc = mysqli_query($conn, "SELECT * FROM orders ORDER BY nomor_meja");
$sort_total_desc = mysqli_query($conn, "SELECT * FROM orders ORDER BY total_bayar DESC");
$sort_total_asc = mysqli_query($conn, "SELECT * FROM orders ORDER BY total_bayar");

if(isset($_GET['sort'])){
	$data_sort = $_GET;
	if($data_sort['sort'] == 'ascT') {
		$sort = $sort_tgl_asc;
	} elseif($data_sort['sort'] == 'descT') {
		$sort = $sort_tgl_desc;    
	} elseif($data_sort['sort'] == 'ascM') {
		$sort = $sort_meja_asc;
	} elseif($data_sort['sort'] == 'descM') {
		$sort = $sort_meja_desc;
	} elseif($data_sort['sort'] == 'ascTo') {
        $sort = $sort_total_asc;
    } elseif($data_sort['sort'] == 'descTo') {
        $sort = $sort_total_desc;
    }
}  else {
	$sort = $data;
}

if (isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
    $deleteSql = "DELETE FROM orders WHERE order_id = $id";
    $deleteResult = mysqli_query($conn, $deleteSql);
    if ($deleteResult) {
        header("Location: order.php");
        exit;
    } else {
        echo "Gagal menghapus Order";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="../orderdetail/admin.php">Order Detail</a>
                    </li> -->
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
        <h1 class="mb-3">Daftar Order</h1>
        <a href="addOrder.php" class="btn btn-primary mb-3">Tambah Orders</a>
        <!-- <a href="addOrder.php?"></a> -->
        <table class="table table-striped table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kode Order</th>
                    <th>
                        Tanggal
                        <?php if(!isset($data_sort['sort']) || $data_sort['sort'] == 'ascT'): ?>
                            <a href='?sort=descT'><i class="fa fa-sort-asc"></i></a>
                        <?php else: ?>
                            <a href='?sort=ascT'><i class="fa fa-sort-desc"></i></a>
                        <?php endif; ?>
                    </th>
                    <th>Jam</th>
                    <th>Pelayan</th>
                    <th>
                        No Meja
                        <?php if(!isset($data_sort['sort']) || $data_sort['sort'] == 'ascM'): ?>
                            <a href='?sort=descM'><i class="fa fa-sort-asc"></i></a>
                        <?php else: ?>
                            <a href='?sort=ascM'><i class="fa fa-sort-desc"></i></a>
                        <?php endif; ?>
                    </th>
                    <th>
                        Jumlah Order
                    </th>
                    <th>
                        Total Harga
                        <?php if(!isset($data_sort['sort']) || $data_sort['sort'] == 'ascTo'): ?>
                            <a href='?sort=descTo'><i class="fa fa-sort-asc"></i></a>
                        <?php else: ?>
                            <a href='?sort=ascTo'><i class="fa fa-sort-desc"></i></a>
                        <?php endif; ?>
                    </th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    while ($row = mysqli_fetch_array($sort)){
                        $raw_total = mysqli_query($conn, "SELECT SUM(jumlah) AS jumlah_order, SUM(sub_total) total FROM order_detail WHERE order_id = '$row[order_id]'");
                        $order_detail = mysqli_fetch_array($raw_total);
                ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $row['order_id'] ?></td>
                    <td><?= $row['tanggal_order'] ?></td>
                    <td><?= $row['jam_order'] ?></td>
                    <td><?= $row['nama_pelayan'] ?></td>
                    <td><?= $row['nomor_meja'] ?></td>
                    <td><?= $order_detail['jumlah_order'] ?></td>
                    <td>Rp <?= number_format($row['total_bayar']) ?></td>
                    <td>
                        <a href="ordersDetail.php?order_id=<?= $row['order_id'] ?>" class="btn btn-primary">Detail</a>
                        <a href="order.php?order_id=<?= $row['order_id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus order dengan ID <?= $row['order_id'] ?>?')">Hapus</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
