<?php
session_start();
require 'konek.php';  // Memasukkan file koneksi

// Koneksi ke database
$conn = connectToDatabase("DESKTOP-EJT421I\\DBMS2024", "PBL_DB");

if (!$conn) {
    // Jika koneksi gagal
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
}

// Query untuk mengambil data agenda
$sql = "SELECT * FROM presma.infoLomba ";

$result = sqlsrv_query($conn, $sql);  // Menjalankan query

if ($result === false) {
    // Jika query gagal
    die("Error executing query: " . print_r(sqlsrv_errors(), true));
}
