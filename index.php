<?php
// Konfigurasi koneksi MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgwebacara8_neww";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Aksi Delete Data
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("DELETE FROM penduduk WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

// Menampilkan data dari tabel penduduk
$sql = "SELECT id, kecamatan, luas, jumlah_penduduk FROM penduduk"; // Pastikan id ada di sini
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Membuat tabel untuk menampilkan data
    echo "<form method='POST' action=''>";
    echo "<table border='1px'>
        <tr>
            <th>Kecamatan</th>
            <th>Luas</th>
            <th>Jumlah Penduduk</th>
            <th>Action</th>
        </tr>";

    // Mengisi tabel dengan data
    while ($row = $result->fetch_assoc()) {
        // Memastikan kolom `id` ada sebelum digunakan
        if (isset($row["id"])) {
            echo "<tr>
                <td>" . htmlspecialchars($row["kecamatan"]) . "</td>
                <td>" . htmlspecialchars($row["luas"]) . "</td>
                <td align='right'>" . htmlspecialchars($row["jumlah_penduduk"]) . "</td>
                <td>
                    <button type='submit' name='delete_id' value='" . htmlspecialchars($row["id"]) . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</button>
                </td>
            </tr>";
        } else {
            echo "<tr><td colspan='4'>ID tidak ditemukan untuk data ini.</td></tr>";
        }
    }
    echo "</table>";
    echo "</form>";
} else {
    echo "0 results";
}

// Menutup koneksi
$conn->close();
?>
