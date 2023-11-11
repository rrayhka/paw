<?php
    include("../koneksi.php");
    $nama = "";
    $telp = "";
    $alamat = "";
    
    $errors = array();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    
        if (empty($nama)) {
            array_push($errors, "Nama Supplier diperlukan");
        }
        if (empty($telp)) {
            array_push($errors, "Nomor Telepon diperlukan");
        }
        if (empty($alamat)) {
            array_push($errors, "Alamat diperlukan");
        }
    
        // Jika tidak ada kesalahan, tambahkan supplier ke database
        if (count($errors) == 0) {
            $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
            mysqli_query($koneksi, $query);
            header('location: suplier.php');
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Praktikum Meet 6</title>
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
                <a class="navbar-brand" href="barang.php">Praktikum</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../transaksi/transaksi.php">Transaksi</a>
                        </li>
                        <li class="nav-item active">
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
        <div class="container mt-4">
            <h1>Tambah Supplier</h1>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama Supplier:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="telp">Telepon:</label>
                    <input type="text" class="form-control" id="telp" name="telp" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Supplier</button>
            </form>
        </div>


    </body>
</html>
