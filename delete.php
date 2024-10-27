<?php
// Ambil ID dari URL
$id = $_GET['id'];

// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = ""; // Ganti dengan password MySQL Anda jika ada
$dbname = "pgwebacara8_neww";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menyusun query SQL untuk menghapus data
$sql = "DELETE FROM penduduk WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data Telah Berhasil Dihapus.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect kembali ke halaman utama setelah 2 detik
header("refresh:2;url=/pgweb/acara7/delete/delete.php");
exit;
?>