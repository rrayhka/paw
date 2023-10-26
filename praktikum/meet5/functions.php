<?php
    $conn = mysqli_connect("localhost", "root", "", "penjualan");

    function tambah($data){
        global $conn;
        $nama = htmlspecialchars($data["nama"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $telp = htmlspecialchars($data["telp"]);

        $query = "INSERT INTO supplier VALUES ('', '$nama', '$alamat', '$telp')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function ubah($data){
        global $conn;
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $telp = htmlspecialchars($data["telp"]);

        $query = "UPDATE supplier SET nama = '$nama', alamat = '$alamat', telp = '$telp' WHERE id = $id";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function delete($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM supplier WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

?>