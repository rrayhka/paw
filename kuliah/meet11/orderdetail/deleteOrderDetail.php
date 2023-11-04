<?php
    include "../koneksi.php";
    if (isset($_GET['order_detail_id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['order_detail_id']);
        $sql = "DELETE FROM order_detail WHERE order_detail_id = $id";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            echo "<script>alert('Data berhasil dihapus!');</script>";
            header("Location: admin.php");
            exit;
        } else {
            echo "Gagal menghapus order_detail_id";
        }
    }
?>