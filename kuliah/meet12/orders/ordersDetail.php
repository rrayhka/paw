<?php
    include "../koneksi.php";
    $order_id = $_GET["order_id"];
    $status = [
        "1" => "Pending",
        "2" => "Process",
        "3" => "Delivered",
        "4" => "Canceled"
    ];

    if(isset($_POST["status"])) {
        $status1 = $_POST["status"];
        $sql = "UPDATE orders SET status = '$status1' WHERE order_id = $order_id";
        mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WarungKU Menu</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="../orderdetail/admin.php">Order Detail</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../orders/addOrder.php">Order</a>
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
        <h1 class="mb-4">Order Detail</h1>
        <table class="table table-striped text-center table-hover table border">
            <thead>
                <th>Order Id</th>
                <th>Nama Menu</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php
                    $count = 1;
                    $order_id = $_GET['order_id'];
                    $sql = "SELECT * FROM orders WHERE order_id = $order_id";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td><?= $row['order_id'] ?></td>
                    <td><?= $row['jam_order'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <form method="post">
                            <select name="status" id="status" onchange="this.form.submit()">
                                <option value="">Pilih Status</option>
                                <?php
                                foreach($status as $key => $value):
                                    ?>
                                <option value="<?= $value ?>"><?= $value; ?></option>
                                <?php
                                endforeach;
                                ?>
                        </select>
                        </form>
                    </td>
                </tr>
                <?php
                    $count++;
                    endwhile;
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>