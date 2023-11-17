<?php
    session_start();
    
    require "koneksi.php";
    
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
    }

    $tableUser = mysqli_query($koneksi, "SELECT * FROM user");
    if(isset($_GET["id_user"])){
        $id = $_GET["id_user"];
        $query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id'");
        if($query){
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Table</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($data = mysqli_fetch_assoc($tableUser)) : ?>
                        <tr>
                            <td><?= $data["username"] ?></td>
                            <td><?= $data["nama"] ?></td>
                            <td><?php echo ($data["level"] == 1) ? "Admin" : "User Biasa"; ?></td>
                            <td>
                                <a href="editUser.php?id_user=<?= $data["id_user"] ?>" class="btn btn-primary">Edit Data</a>
                                <a href="index.php?id_user=<?= $data["id_user"] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Bootstrap JS Bundle (Popper included) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
