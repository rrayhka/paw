<?php
    include 'conn.php';
    $query = mysqli_query($conn, "SELECT * FROM tb_rekammedis");
    $nomor = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Rekam Medis</h1>
        <a href="addRekamMedis.php"><button type="button" class="btn btn-primary mb-3">Tambah Data</button></a>
        <table class="table table-bordered text-center table-hover">
            <thead class="thead-dark table-primary">
                <tr>
                    <th>Nomor</th>
                    <th>Id Pasien</th>
                    <th>Keluhan</th>
                    <th>Id Dokter</th>
                    <th>Diagnosa</th>
                    <th>Id Poli</th>
                    <th>Tanggal Periksa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)) : ?>
                        <tr>
                            <td><?= $nomor; ?></td>
                            <td><?= $row['id_pasien']; ?></td>
                            <td><?= $row['keluhan']; ?></td>
                            <td><?= $row['id_dokter']; ?></td>
                            <td><?= $row['diagnosa']; ?></td>
                            <td><?= $row['id_poli']; ?></td>
                            <td><?= $row['tgl_periksa']; ?></td>
                            <td>
                                <a href="editRekamMedis.php?id_rm=<?= $row["id_rm"]; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                                <a href="index.php?id_rm=<?= $row["id_rm"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                            </td>
                        </tr>
                    <?php $nomor++; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php
        if(isset($_GET['id_rm'])) {
            $id_rm = $_GET['id_rm'];
            $query = mysqli_query($conn, "DELETE FROM tb_rekammedis WHERE id_rm = '$id_rm'");
            if($query) {
                echo "
                    <script>
                        alert('Data Berhasil dihapus');
                        document.location.href = 'index.php';
                    </script>
                ";
            }
        }
    ?>
</body>
</html>
