<?php
    require 'functions.php';
    $id = $_GET["id"];
    $supplier = mysqli_query($conn, "SELECT * FROM supplier WHERE id = $id");
    $row = mysqli_fetch_assoc($supplier);
    if( isset($_POST["submit"]) ) {
        if( ubah($_POST) > 0 ) {
            echo "
                <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Supplier</title>
    <!-- Add the Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Ubah Data Supplier</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $row["nama"] ?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $row["alamat"] ?>">
        </div>
        <div class="form-group">
            <label for="telp">Telepon</label>
            <input type="text" class="form-control" name="telp" id="telp" value="<?= $row["telp"] ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Ubah Data</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>

    <!-- Add the Bootstrap JS and Popper.js scripts (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
