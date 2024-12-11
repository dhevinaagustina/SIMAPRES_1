<?php
session_start();
require 'konek.php';

// Koneksi ke database
$conn = connectToDatabase("LAPTOP-OF3KH5J0\DBMS2024", "PBL_DB");

try {
    $query = "SELECT * FROM presma.infoLomba";
    $stmt = sqlsrv_query($conn, $query);

    if ($stmt === false) {
        throw new Exception(print_r(sqlsrv_errors(), true));
    }

    $data = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }

    // Kembalikan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($data);

} catch (Exception $e) {
    echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
}
?>

