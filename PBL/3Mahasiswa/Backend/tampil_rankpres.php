<?php
session_start(); // Koneksi ke database
require 'konek.php';  //file koneksi

$conn = connectToDatabase("NXST-planet\DBMS2022", "PBL_DB"); // Koneksi ke database

if (!$conn) {
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true)); // print error jika koneksi gagal
}

$sql = "{CALL GetMahasiswaRanking}"; //memanggil stored procedure
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die("Kesalahan dalam memanggil stored procedure: " . print_r(sqlsrv_errors(), true));
}

$results = []; // Mengambil hasil dari stored procedure
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results[] = $row;
}

// Tutup koneksi ke database
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

$_SESSION['ranking_results'] = $results;
?>