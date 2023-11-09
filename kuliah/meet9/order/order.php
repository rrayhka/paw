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
            <a href="addOrder.php" class="btn btn-primary mb-3">Tambah Pesanan</a>
        </div>
    </body>
</html>