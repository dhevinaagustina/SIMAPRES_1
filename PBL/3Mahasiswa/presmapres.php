<?php
session_start();
require 'backend/konek.php';  // Memasukkan file koneksi
require_once 'Sidebar.php';

// Koneksi ke database
$conn = connectToDatabase("NXST-planet\DBMS2022", "PBL_DB");

if (!$conn) {
    // Jika koneksi gagal
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
}

// Query untuk mengambil data agenda
$sql = "SELECT * FROM presma.Kompetisi WHERE status='1'";

$result = sqlsrv_query($conn, $sql);  // Menjalankan query

if ($result === false) {
    // Jika query gagal
    die("Error executing query: " . print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            background-image:url(../Asset/Background\ landscape.png);
        }

        .main-content {
            flex: 1;
            padding: 32px 48px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .linkKompetisi {
            color: white;
            font-weight: bold;
            font-size: 22px;
        }

        .linkPrestasi {
            color: white;
            font-weight: bold;
            font-size: 22px;
            text-shadow: 2px 2px 4px rgba(43, 35, 88, 0.7);
        }

        .page-title {
            font-size: 2.5rem;
            color: white;
            font-weight: bold;
            margin-bottom: 8px;
            text-align: center;
        }

        .page-nav {
            display: flex;
            gap: 16px;
            color: rgba(255, 255, 255, 0.8);
            justify-content: center;
        }

        .section {
            margin-bottom: 48px;
        }

        .achievement-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
        }

        .achievement-info h3 {
            color: white;
            font-size: 1.75rem;
            margin-bottom: 8px;
        }

        .achievement-meta {
            display: flex;
            gap: 16px;
            color: rgba(255, 255, 255, 0.8);
        }

        .achievement-status {
            text-align: right;
        }

        .score {
            color: white;
            font-size: 1.25rem;
        }

        .status {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
    <?php Sidebar::render(); //modularitas, memanggil sidebar?>

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Prestasi Mahasiswa</h1>
            <div class="page-nav">
            <a href="presmakomp.php" class="linkKompetisi">Kompetisi</a>
                <span>|</span>
                <a href="presmapres.php" class="linkPrestasi">Prestasi</a>
            </div>
        </div>

        <div class="section">
            <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                <div class="achievement-card">
                    <div class="achievement-info">
                        <h3><?php echo htmlspecialchars($row['judul_kompetisi']); ?></h3>
                        <div class="achievement-meta">
                            <span><?php echo htmlspecialchars($row['tingkat_kompetisi']); ?></span>
                            <span>|</span>
                            <span><?php echo htmlspecialchars($row['jenis_kompetisi']); ?></span>
                        </div>
                    </div>
                    <div class="achievement-status">
                        <div class="score">
                            <?php echo isset($row['skor']) ? htmlspecialchars($row['skor']) : '-'; ?>
                        </div>
                        <div class="status">Tervalidasi</div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
