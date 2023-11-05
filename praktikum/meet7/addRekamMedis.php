<?php
    include 'conn.php';
    if (isset($_POST["submit"])) {
        if (tambah_rekam_medis($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil ditambahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "tidak berhasil";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        select {
            width: 98%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        textarea,
        input[type="date"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Rekam Medis</h1>
        <form method="post">
            <label for="id_pasien">Nama Pasien</label>
            <select name="id_pasien" id="id_pasien" required>
                <option value="" disabled selected>Pilih Nama Pasien</option>
                <?php
                    $pasien = mysqli_query($conn, "SELECT * FROM tb_pasien");
                    while ($row = mysqli_fetch_array($pasien)) {
                        echo "<option value='" . $row['id_pasien'] . "'>" . $row['nama_pasien'] . "</option>";
                    }
                ?>
            </select>

            <label for="keluhan">Keluhan</label>
            <textarea name="keluhan" id="keluhan" cols="30" rows="5" required></textarea>

            <label for="id_dokter">Dokter</label>
            <select name="id_dokter" id="id_dokter" required>
                <option value="" disabled selected>Pilih Nama Dokter</option>
                <?php
                    $dokter = mysqli_query($conn, "SELECT * FROM tb_dokter");
                    while ($row = mysqli_fetch_array($dokter)) {
                        echo "<option value='" . $row['id_dokter'] . "'>" . $row['nama_dokter'] . "</option>";
                    }
                ?>
            </select>

            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" cols="30" rows="5" required></textarea>

            <label for="id_poli">Nama Poli</label>
            <select name="id_poli" id="id_poli" required>
                <option value="" disabled selected>Pilih Nama Poli</option>
                <?php
                    $poli = mysqli_query($conn, "SELECT * FROM tb_poliklinik");
                    while ($row = mysqli_fetch_array($poli)) {
                        echo "<option value='" . $row['id_poli'] . "'>" . $row['nama_poli'] . "</option>";
                    }
                ?>
            </select>

            <label for="tanggal_periksa">Tanggal Periksa</label>
            <input type="date" name="tanggal_periksa" id="tanggal_periksa" required>

            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
