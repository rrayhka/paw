<!DOCTYPE html>
<html lang="en">
<head>
    <title>Warungku</title>
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
    <h1 class="mb-4">Daftar Menu</h1>
    <a href="showFormAddMenu.php" class="btn btn-primary mb-3">Tambah Menu</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "kuliah");
                $query = "SELECT * FROM menu";
                $result = mysqli_query($conn, $query);
                $indeks = 1;
                while($row = mysqli_fetch_assoc($result)){
                    echo "
                        <tr>
                            <td>$indeks</td>
                            <td>
                                <a href='editMenu.php?id=$row[menu_id]' class='btn btn-primary'>Edit</a>
                                <a href='deleteMenu.php?id=$row[menu_id]' class='btn btn-danger'>Delete</a>
                            </td>
                            <td>$row[nama_menu]</td>
                            <td>$row[harga]</td>
                            <td>$row[kategori]</td>
                        </tr>
                    ";
                    $indeks++;
                }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
