<?php 
session_start(); // Pastikan untuk memulai sesi sebelum mengakses atau menghapus session

// Hapus semua variabel session
session_unset();

// Hapus session data dari penyimpanan
session_destroy();

// Redirect atau tindakan lain setelah logout
// Contoh: Redirect ke halaman login
header("Location: login.php");
exit(); // Pastikan untuk keluar setelah melakukan redirect
