<?php
// Pastikan untuk mengimpor file koneksi database
require_once '../Validasi.php'; // Ganti dengan file koneksi database Anda

// Koneksi ke database
$conn = connectToDatabase("LAPTOP-OF3KH5J0\DBMS2024", "PBL_DB");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Ambil ID kompetisi dari form
    $id_kompetisi = $_POST['id'];

    // Query untuk memperbarui status menjadi 1
    $sql = "UPDATE presma.Kompetisi SET status = 1 WHERE id_kompetisi = ?";

    // Menggunakan prepared statement untuk keamanan
    $params = array($id_kompetisi);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    // Eksekusi query
    if ($stmt && sqlsrv_execute($stmt)) {
        // Jika berhasil, redirect ke halaman sebelumnya atau halaman lain
        header("Location: dashboarddosen.php"); // Ganti dengan halaman tujuan Anda
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Terjadi kesalahan saat memperbarui status: " . print_r(sqlsrv_errors(), true);
    }

    // Bebaskan statement
    sqlsrv_free_stmt($stmt);
} else {
    // Jika permintaan tidak valid, tampilkan pesan error
    echo "Permintaan tidak valid.";
}

// Tutup koneksi
sqlsrv_close($conn);
?>
