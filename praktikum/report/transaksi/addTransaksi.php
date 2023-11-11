<?php
    include('../koneksi.php');
    $total = 0;
    function sumPriceByQuantity(){
        global $koneksi;
        global $total;
        $query = mysqli_query($koneksi, "SELECT harga FROM barang WHERE nama_barang = '$_POST[nama_barang]'");
        $harga = mysqli_fetch_array($query)['harga'];
        $total = $harga * $_POST['quantities'];
        return $total;
    }
    if(isset($_POST['submit'])) {
        // var_dump($_POST['nama_pelanggan'], $_POST['nama_barang'], $_POST['date'], $_POST['keterangan'], $_POST['quantities'], sumPriceByQuantity());
        $query = mysqli_query($koneksi, "INSERT INTO transaksi (pelanggan_id, waktu_transaksi, keterangan, total) VALUES ('$_POST[nama_pelanggan]', '$_POST[date]', '$_POST[keterangan]', '".sumPriceByQuantity()."')");
        if($query) {
            $barang_id = mysqli_query($koneksi, "SELECT id FROM barang WHERE nama_barang = '$_POST[nama_barang]'");
            $queryTransaksiDetail = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (LAST_INSERT_ID(), '".mysqli_fetch_array($barang_id)['id']."', '".sumPriceByQuantity()."', '$_POST[quantities]')");
            echo "<script>alert('Data berhasil ditambahkan');
            document.location.href='transaksi.php';
            </script>";
        } else {
            echo "<script>alert('Data gagal ditambahkan');</script>";
        }
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
    <div class="container">
        <a href="transaksi.php" class="btn btn-primary my-3">Kembali</a>
        <form method="post">
            <div class="form-group">
                <label for="nama_pelanggan">Pelanggan</label>
                <select class="form-control" name="nama_pelanggan" id="nama_pelanggan" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while($data = mysqli_fetch_array($query)){
                            echo "<option value='$data[id]'>$data[nama]</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <select class="form-control" name="nama_barang" id="nama_barang" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM barang");
                        while($data = mysqli_fetch_array($query)){
                            echo "<option value='$data[nama_barang]'>$data[nama_barang]</option>";
                        }
                    ?>
                </select>
            </div>
            <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
            <div class="form-group">
                <label for="keterangan">Isi Keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="quantities">Jumlah</label>
                <input type="number" class="form-control" name="quantities" id="quantities" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="total">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <!-- Include Bootstrap JavaScript and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
