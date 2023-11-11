<?php
    include '../koneksi.php';
    $transaksi_id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");

    $queryBarangBelumAda = "SELECT * FROM barang 
    WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = '$transaksi_id')";
    $resultBarangBelumAda = mysqli_query($koneksi, $queryBarangBelumAda);

    $queryTransaksiDetail = "SELECT td.*, b.kode_barang, b.nama_barang, b.harga 
    FROM transaksi_detail td
    INNER JOIN barang b ON td.barang_id = b.id
    WHERE td.transaksi_id = '$transaksi_id'";
    $resultTransaksiDetail = mysqli_query($koneksi, $queryTransaksiDetail);

    if (isset($_POST['submit'])) {
        $barang_id = $_POST['nama_barang'];
        $quantities = $_POST['quantities'];

        $barangSudahAda = false;
        while ($row = mysqli_fetch_assoc($resultTransaksiDetail)) {
        if ($row['barang_id'] == $barang_id) {
            $barangSudahAda = true;
            break;
            }
        }

        if (!$barangSudahAda) {
            $queryBarang = "SELECT * FROM barang WHERE id = '$barang_id'";
            $resultBarang = mysqli_query($koneksi, $queryBarang);

            if ($rowBarang = mysqli_fetch_assoc($resultBarang)) {
                $harga = $quantities * $rowBarang['harga'];

                $insertQuery = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$barang_id', '$harga', '$quantities')");
                if($insertQuery) {
                    $hargaTotal = mysqli_query($koneksi, "SELECT SUM(harga) AS total_harga FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");
                    $totalHarga = mysqli_fetch_assoc($hargaTotal);
                    $updateTotal = mysqli_query($koneksi, "UPDATE transaksi SET total = '$totalHarga[total_harga]' WHERE id = '$transaksi_id'");
                    if($updateTotal) {
                        header("Location: transaksi.php");
                    }
                } else {
                    echo "Gagal menambahkan ke transaksi_detail.";
                }
            } else {
                echo "Barang tidak ditemukan.";
            }
        } else {
            echo "Barang sudah ada di transaksi_detail.";
        }

        $resultTransaksiDetail = mysqli_query($koneksi, $queryTransaksiDetail);
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Praktikum</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="barang.php">Praktikum</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../transaksi/transaksi.php">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../suplier/suplier.php">Suplier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../barang/barang.php">Barang</a>
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
            <a href="transaksi.php" class="btn btn-primary mb-3">Kembali ke Transaksi</a>
            <table class="table table-striped table-bordered">
                <thead class="thead-primary">
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <form method="post">
                        <tr>
                            <td>
                            <select name="nama_barang" id="nama_barang" class="form-control" required style="text-align: center;"> 
                                <option value="">-- Pilih Barang --</option>
                                <?php
                                while ($data = mysqli_fetch_array($resultBarangBelumAda)) {
                                    echo "<option value='$data[id]'>$data[nama_barang]</option>";
                                }
                                ?>
                            </select>
                            </td>
                            <td>
                                <input type="number" name="quantities" id="quantities" class="form-control" required style="text-align: center;">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
            <!-- breakdown untuk read data berdasarkan transaksi id -->

            <!-- Tabel untuk menampilkan barang yang sudah terpilih -->
            <table class="table table-striped table-bordered text-center table-hover">
                <thead class="table-primary">
                    <!-- <th>Tanggal</th> -->
                    <th>Transaksi ID</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Quantity</th>
                    <th>Harga Per Biji</th>
                </thead>
                <tbody>
                    <?php 
                    while ($row = mysqli_fetch_assoc($resultTransaksiDetail)) {
                        echo "<tr>";
                        // echo "<td>{$row['waktu_tran']}</td>";
                        echo "<td>{$row['transaksi_id']}</td>";
                        echo "<td>{$row['kode_barang']}</td>";
                        echo "<td>{$row['nama_barang']}</td>";
                        echo "<td>{$row['qty']}</td>";
                        echo "<td>{$row['harga']}</td>";
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="4">
                            Total Harga
                        </td>
                        <td colspan="">
                            <?php
                                $hargaTotal = mysqli_query($koneksi, "SELECT SUM(harga) AS total_harga FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");
                                $totalHarga = mysqli_fetch_assoc($hargaTotal);
                                echo $totalHarga['total_harga'];
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>