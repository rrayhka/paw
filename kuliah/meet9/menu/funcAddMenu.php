<?php
// Koneksi ke database menggunakan MySQLi
$host = "localhost";
$username = "root";
$password = "";
$database = "kuliah";
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Dapatkan data dari form
$nama_menu = $_POST["nama_menu"];
$harga = $_POST["harga"];
$kategori = $_POST["kategori"];

// Ambil id terakhir dari kolom menu_id
$query = "SELECT MAX(menu_id) + 1 AS next_id FROM menu;";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$next_id = $row["next_id"];

// Buat query untuk menambahkan menu ke database
$query = "INSERT INTO menu (nama_menu, harga, kategori, menu_id) VALUES (?, ?, ?, ?)";

// Prepare query
$stmt = $conn->prepare($query);

// Bind parameter
$stmt->bind_param("sssi", $nama_menu, $harga, $kategori, $next_id);

// Jalankan query
if ($stmt->execute()) {
    // Redirect ke halaman menu jika berhasil
    header("Location: menu.php");
} else {
    echo "Gagal menambahkan menu: " . $conn->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
