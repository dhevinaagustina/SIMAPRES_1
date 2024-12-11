<?php

function connectToDatabase($servername, $dbname) {
    $connectionOptions = array(
        "Database" => $dbname,
        "UID" => "",  // Username jika menggunakan autentikasi SQL Server
        "PWD" => "",  // Password jika menggunakan autentikasi SQL Server
    );

    // Menggunakan sqlsrv_connect untuk koneksi ke SQL Server
    $conn = sqlsrv_connect($servername, $connectionOptions);

    // Cek apakah koneksi berhasil
    if (!$conn) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    }

    return $conn;
}

// Mendefinisikan koneksi
$servername = "DESKTOP-EJT421I\DBMS2024";  // Ganti dengan nama server Anda
$dbname = "PBL_DB";         // Nama database Anda

$conn = connectToDatabase($servername, $dbname);

// Query untuk mendapatkan data mahasiswa
$sql_mahasiswa = "SELECT nim, nama FROM presma.Mahasiswa";
$sql_dosen = "SELECT nip, nama FROM presma.Dosen";

// Query untuk mahasiswa
$query_mahasiswa = sqlsrv_query($conn, $sql_mahasiswa);
$options_mahasiswa = [];
if ($query_mahasiswa) {
    while ($row = sqlsrv_fetch_array($query_mahasiswa, SQLSRV_FETCH_ASSOC)) {
        $options_mahasiswa[] = $row; // Menambahkan data mahasiswa ke array
    }
}

// Query untuk dosen
$query_dosen = sqlsrv_query($conn, $sql_dosen);
$options_dosen = [];
if ($query_dosen) {
    while ($row = sqlsrv_fetch_array($query_dosen, SQLSRV_FETCH_ASSOC)) {
        $options_dosen[] = $row; // Menambahkan data dosen ke array
    }
}

// Tutup koneksi setelah selesai
sqlsrv_close($conn);

?>


