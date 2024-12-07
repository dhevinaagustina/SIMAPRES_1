<?php
session_start();
require 'konek.php';

// Berikan parameter sesuai kebutuhan
$conn = connectToDatabase("LAPTOP-OF3KH5J0\DBMS2024", "PBL_DB");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = "
            SELECT username, password, 'admin' AS role FROM presma.Admin WHERE username = ?
            UNION
            SELECT username, password, 'dosen' AS role FROM presma.Dosen WHERE username = ?
            UNION
            SELECT username, password, 'mahasiswa' AS role FROM presma.Mahasiswa WHERE username = ?
        ";

        $params = [$username, $username, $username];
        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($user) {
            if ($password == $user['password']) { 
                session_regenerate_id(true);
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];

                switch ($user['role']) {
                    case 'admin':
                        header("Location: ../1Admin/Beranda.html");
                        break;
                    case 'dosen':
                        header("Location: ../2Dosen/dashboarddosen.html");
                        break;
                    case 'mahasiswa':
                        header("Location: ../3Mahasiswa/dashboard.html");
                        break;
                }
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    } catch (Exception $e) {
        $error = "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
    }
}
?>