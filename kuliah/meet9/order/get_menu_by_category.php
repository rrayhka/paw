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

// Ambil nilai jenis_makanan dari POST
$jenis_makanan = $_POST['jenis_makanan'];

// Query untuk mendapatkan nama menu berdasarkan jenis makanan
$query = "SELECT nama_menu FROM menu WHERE kategori = ?";

// Prepare query
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $jenis_makanan);

// Eksekusi query
$stmt->execute();

// Simpan hasil query ke dalam array
$stmt->bind_result($nama_menu);
$menuItems = array();
while ($stmt->fetch()) {
    $menuItems[] = $nama_menu;
}

// Buat opsi <option> berdasarkan hasil query
$options = '<option value="" disabled selected>Silahkan pilih</option>';
foreach ($menuItems as $item) {
    $options .= "<option value='$item'>$item</option>";
}

// Keluarkan hasil sebagai respon untuk permintaan AJAX
echo $options;

// Tutup koneksi
$stmt->close();
$conn->close();
?>
