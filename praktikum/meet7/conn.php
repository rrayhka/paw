<?php
    $conn = mysqli_connect("localhost", "root", "", "db_rumahsakit");
    function generateID($table, $kolom){
        global $conn;
        $var = mysqli_query($conn, "SELECT MAX($kolom) as maxID FROM $table");
        $row = mysqli_fetch_assoc($var);
        $id = $row['maxID'];
        $new_id = intval(substr($id, 2)) + 1;
        if(strlen($new_id) == 1){
            $result = substr($id, 0, 2) . "00" . $new_id;
        } else if(strlen($new_id) == 2){
            $result = substr($id, 0, 2) . "0" . $new_id;
        } else {
            $result = substr($id, 0, 2) . $new_id;
        }
        return $result;
    }

    function tambah_rekam_medis($data) {
        global $conn;
        $id_rm = generateID("tb_rekammedis", "id_rm");
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