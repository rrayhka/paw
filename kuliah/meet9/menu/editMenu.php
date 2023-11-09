<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Menu - Warungku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="menu.php">WarungKU</a>
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
    <h1 class="mb-4">Edit Menu</h1>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "kuliah");

        if ($_SERVER['REQUEST_METHOD'] == 'GET' || isset($_GET['id'])) {
            $menu_id = $_GET['id'];
            $query = "SELECT * FROM menu WHERE menu_id = $menu_id";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $menu = mysqli_fetch_assoc($result);
            } else {
                echo "<div class='alert alert-danger'>Menu not found.</div>";
                exit;
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid request.</div>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $nama_menu = mysqli_real_escape_string($conn, $_POST["nama_menu"]);
            $harga = floatval($_POST["harga"]);
            $kategori = mysqli_real_escape_string($conn, $_POST["kategori"]);
            $update_query = "UPDATE menu SET nama_menu = '$nama_menu', harga = $harga, kategori = '$kategori' WHERE menu_id = $menu_id";

            if (mysqli_query($conn, $update_query)) {
                echo "<div class='alert alert-success'>Menu updated successfully.</div>";
                echo "<meta http-equiv='refresh' content='1;url=menu.php'>";
            } else {
                echo "<div class='alert alert-danger'>Error updating menu.</div>";
                echo "<meta http-equiv='refresh' content='1;url=menu.php'>";
            }
        }
    ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama_menu">Nama Menu</label>
            <input type="text" name="nama_menu" id="nama_menu" class="form-control" value="<?php echo $menu['nama_menu']; ?>" placeholder="Masukkan nama menu">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="<?php echo $menu['harga']; ?>" placeholder="Masukkan harga">
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control">
                <option value="makanan" <?php echo ($menu['kategori'] == 'makanan') ? 'selected' : ''; ?>>Makanan</option>
                <option value="minuman" <?php echo ($menu['kategori'] == 'minuman') ? 'selected' : ''; ?>>Minuman</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update Menu</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='menu.php'">Kembali ke Menu</button>
    </form>
</div>

</body>
</html>
