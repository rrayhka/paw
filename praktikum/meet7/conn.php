<?php
    $conn = mysqli_connect("localhost", "root", "", "db_rumahsakit");
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    function primaryKey($alpha, $queryPK){
        global $conn;
        $nums = "0123456789";
        $row = mysqli_fetch_array($queryPK);
        $id = $row[0];
        $id = substr($id, 2);
        $id = (int)$id;
        $id = $id + 1;
        $id = $alpha . $id;
        return $id;
    }
?>