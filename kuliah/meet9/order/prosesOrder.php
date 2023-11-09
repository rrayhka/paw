<?php
// Koneksi ke database menggunakan MySQLi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kuliah";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari formulir
$nama_pembeli = $_POST['nama'];
$jenis_makanan = $_POST['jenis_makanan'];
$nama_makanan = $_POST['nama_makanan'];
$harga = $_POST['harga'];
$nama_pelayan = $_POST['nama_pelayan'];
$nomor_meja = $_POST['nomor_meja'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];

try {
    // Query untuk menyimpan data ke tabel orderDetail
    $query = "INSERT INTO orderdetail (nomor_meja, nama_pembeli, jenis_makanan, nama_makanan, harga, tanggal, jam, nama_pelayan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Binding parameter
    $stmt->bind_param("ssssssss", $nomor_meja, $nama_pembeli, $jenis_makanan, $nama_makanan, $harga, $tanggal, $jam, $nama_pelayan);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman sukses atau halaman lain yang sesuai
        header("Location: ../orderdetail/admin.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
