<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
        <h1 class="mb-4 text-center">Data Master Supplier</h1>
        <a href="tambah.php" class="btn btn-primary mb-3">Tambah Data</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'functions.php';
                    $supplier = mysqli_query($conn, "SELECT * FROM supplier");
                    $i = 1;
                    while($row = mysqli_fetch_assoc($supplier)){
                        echo "<tr class='text-center'>";
                        echo "<th scope='row'>$i</th>";
                        echo "<td>$row[nama]</td>";
                        echo "<td>$row[alamat]</td>";
                        echo "<td>$row[telp]</td>";
                        echo "<td><a href='edit.php?id=$row[id]' class='btn btn-warning btn-sm'>Edit</a> <a class='btn btn-danger btn-sm' onclick='return hapus($row[id])'>Delete</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function hapus(e){
            if(confirm('Apakah Anda yakin ingin menghapus data ini?')){
                window.location = `delete.php?id=${e}`;
            }
        }
    </script>
</body>
</html>
