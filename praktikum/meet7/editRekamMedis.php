<?php
    include "conn.php";
    $id_rm = $_GET['id_rm']; 
    $query = mysqli_query($conn, "SELECT * FROM tb_rekammedis WHERE id_rm = '$id_rm'");
    $rm = mysqli_fetch_assoc($query);
    if(isset($_POST["submit"])){
        $id_pasien = $_POST["id_pasien"];
        $keluhan = $_POST["keluhan"];
        $id_dokter = $_POST["id_dokter"];
        $diagnosis = $_POST["diagnosa"];
        $id_poli = $_POST["id_poli"];
        $tanggal_periksa = $_POST["tanggal_periksa"];
        var_dump($id_rm, $id_pasien, $keluhan, $id_dokter, $diagnosis, $id_poli, $tanggal_periksa);
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <form method="post">
                <div class="form-group">
                    <label for="id_pasien">Id Pasien</label>
                    <select class="form-control" name="id_pasien" id="id_pasien">
                        <option value="" disabled selected>Silahkan Ganti Pasien</option>
                        <?php
                        $pasien = mysqli_query($conn, "SELECT * FROM tb_pasien");
                        while ($row = mysqli_fetch_assoc($pasien)) : ?>
                            <option value="<?= $row["id_pasien"] ?>"><?= $row["nama_pasien"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keluhan">Keluhan</label>
                    <textarea class="form-control" name="keluhan" id="keluhan" rows="5" placeholder="Keluhan"><?= $rm["keluhan"]; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="id_dokter">Id Dokter</label>
                    <select class="form-control" name="id_dokter" id="id_dokter">
                        <option value="" disabled selected>Silahkan Ganti Dokter</option>
                        <?php
                        $dokter = mysqli_query($conn, "SELECT * FROM tb_dokter");
                        while ($row = mysqli_fetch_assoc($dokter)) : ?>
                            <option value="<?= $row["id_dokter"] ?>"><?= $row["nama_dokter"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="diagnosa">Diagnosa</label>
                    <textarea class="form-control" name="diagnosa" id="diagnosa" rows="5" placeholder="Diagnosa"><?= htmlspecialchars($rm["diagnosa"]); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="id_poli">Poli</label>
                    <select class="form-control" name="id_poli" id="id_poli">
                        <option value="" disabled selected>Silahkan Ganti Poli</option>
                        <?php
                        $poliklinik = mysqli_query($conn, "SELECT * FROM tb_poliklinik");
                        while ($row = mysqli_fetch_assoc($poliklinik)) : ?>
                            <option value="<?= $row["id_poli"] ?>"><?= $row["nama_poli"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_periksa">Tanggal Periksa</label>
                    <input type="date" class="form-control" name="tanggal_periksa" id="tanggal_periksa" value="<?= $rm["tgl_periksa"]; ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>

    </body>
</html>
