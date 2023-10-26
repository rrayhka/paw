<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Menu - Warungku</title>
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
    <h1 class="mb-4">Hapus Menu</h1>
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
                $delete_query = "DELETE FROM menu WHERE menu_id = $menu_id";

                if (mysqli_query($conn, $delete_query)) {
                    echo "<div class='alert alert-success'>Menu deleted successfully.</div>";
                    echo "<meta http-equiv='refresh' content='1;url=menu.php'>";
                } else {
                    echo "<div class='alert alert-danger'>Error deleting menu.</div>";
                    echo "<meta http-equiv='refresh' content='1;url=menu.php'>";
                }
            }
        }
    ?>
    <p>Anda yakin ingin menghapus menu ini?</p>
    <form action="" method="post">
        <button type="submit" class="btn btn-danger" name="delete">Hapus Menu</button>
    </form>
</div>

</body>
</html>
