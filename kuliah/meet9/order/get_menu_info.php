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

// Ambil nilai nama_makanan dari POST
$nama_makanan = $_POST['nama_makanan'];

// Query untuk mendapatkan informasi menu berdasarkan nama makanan
$query = "SELECT * FROM menu WHERE nama_menu = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nama_makanan);

// Eksekusi query
$stmt->execute();

// Simpan hasil query ke dalam array
$result = $stmt->get_result();
$menu_info = $result->fetch_assoc();

// Keluarkan hasil sebagai JSON
echo json_encode($menu_info);

// Tutup koneksi
$stmt->close();
$conn->close();
?>
