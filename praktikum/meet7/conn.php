<?php
    $conn = mysqli_connect("localhost", "root", "", "db_rumahsakit");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    function generateID($table, $kolom,  $length) {

        $lastID = query("SELECT MAX($kolom) as maxID FROM $table")[0];
        $kode = $lastID["maxID"];
        $kode++;
        $result = sprintf("%0" . $length . "s", $kode);
        return $result;
    }

    function tambah_rekam_medis($data) {
        global $conn;
        $id_rm = generateID("tb_rekammedis", "id_rm", 3);
        $id_pasien = htmlspecialchars($data["id_pasien"]);
        $keluhan = htmlspecialchars($data["keluhan"]);
        $id_dokter = htmlspecialchars($data["id_dokter"]);
        $diagnosa = htmlspecialchars($data["diagnosa"]);
        $id_poli = htmlspecialchars($data["id_poli"]);
        $tanggal = htmlspecialchars($data["tanggal_periksa"]);

        mysqli_query($conn, "INSERT INTO `tb_rekammedis`
                    (id_rm, id_pasien, keluhan, id_dokter, diagnosa, id_poli, tgl_periksa)
                    VALUES ('$id_rm', '$id_pasien', '$keluhan', '$id_dokter', '$diagnosa', '$id_poli', '$tanggal')");
        return mysqli_affected_rows($conn);
    }
?>