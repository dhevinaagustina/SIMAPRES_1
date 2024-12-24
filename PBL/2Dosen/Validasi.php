<?php
// Memulai session


// Memasukkan koneksi ke database
require_once 'backend/ctgvalidasi.php'; // Pastikan file koneksi benar dan sesuai

// Fungsi koneksi ke database
$conn = connectToDatabase("LAPTOP-OF3KH5J0\DBMS2024", "PBL_DB");

if (!$conn) {
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
}

// Mendapatkan data kompetisi berdasarkan ID (jika ada)
$row = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM presma.Kompetisi WHERE id_kompetisi = ?";
    $params = array($id);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    } else {
        die("Terjadi kesalahan dalam pengambilan data: " . print_r(sqlsrv_errors(), true));
    }
} else {
    die("ID kompetisi tidak ditemukan.");
}

// Konversi tanggal ke format 'Y-m-d' jika diperlukan
$tanggal_mulai = $row['tanggal_mulai'] instanceof DateTime ? $row['tanggal_mulai']->format('Y-m-d') : 'N/A';
$tanggal_akhir = $row['tanggal_akhir'] instanceof DateTime ? $row['tanggal_akhir']->format('Y-m-d') : 'N/A';
$tanggal_surat_tugas = $row['tanggal_surat_tugas'] instanceof DateTime ? $row['tanggal_surat_tugas']->format('Y-m-d') : 'N/A';

// Proses validasi data (jika form dikirimkan)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id_kompetisi = $_POST['id'];
    $sql_update = "UPDATE presma.Kompetisi SET status = 1 WHERE id_kompetisi = ?";
    $params_update = array($id_kompetisi);
    $stmt_update = sqlsrv_prepare($conn, $sql_update, $params_update);

    if ($stmt_update && sqlsrv_execute($stmt_update)) {
        // Redirect ke halaman dashboard jika berhasil
        header("Location: dashboarddosen.php");
        exit();
    } else {
        die("Gagal memvalidasi data: " . print_r(sqlsrv_errors(), true));
    }
}

// Tutup koneksi
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Page</title>
    <link rel="stylesheet" type="text/css" href="../2Dosen/Validasi.css">
</head>
<body>
    <div class="sidebar">
        <div class="user-profile">
            <div class="user-avatar"></div>
            <span class="username">Username</span>
        </div>
        
        <a href="dashboarddosen.php" class="menu-item">
            <!-- Ikon dan teks menu -->
            Beranda
        </a>
        <a href="validasipres1.html" class="menu-item">
            Validasi & Daftar Prestasi
        </a>
        <a href="agendakompdosen.php" class="menu-item">
            Agenda Kompetisi
        </a>
        <a href="rankpresdosen.html" class="menu-item">
            Rangking Prestasi
        </a>
        <a href="../0Loginpage/login.html" id="logout-button" class="menu-item hidden">Keluar</a>
    </div>

    <div class="main-content">
        <div class="box1">
            <h1 class="welcome-text">Data Kompetisi</h1>
        </div>
        
        <div class="data">
            <div class="kompetisi">
                <h2>Kompetisi</h2>
                <div>
                    <label for="judul">Judul Kompetisi:</label>
                    <span id="judul"><?php echo htmlspecialchars($row['judul_kompetisi'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="url-kompetisi">URL Kompetisi:</label>
                    <span id="url-kompetisi"><?php echo isset($row['url_kompetisi']) ? htmlspecialchars($row['url_kompetisi'], ENT_QUOTES, 'UTF-8') : 'N/A'; ?></span>
                </div>
                <div>
                    <label for="tempat">Tempat Kompetisi:</label>
                    <span id="tempat"><?php echo htmlspecialchars($row['tempat_kompetisi'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="tanggal">Tanggal Mulai:</label>
                    <span id="tanggal-mulai"><?php echo htmlspecialchars($tanggal_mulai, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="tanggal">Tanggal Akhir:</label>
                    <span id="tanggal-akhir"><?php echo htmlspecialchars($tanggal_akhir, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="pt">Jumlah PT (Berpartisipasi):</label>
                    <span id="pt"><?php echo htmlspecialchars($row['jumlah_pt'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="no-surat">No Surat Tugas:</label>
                    <span id="no-surat"><?php echo htmlspecialchars($row['no_surat_tugas'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="tanggal-surat">Tanggal Surat Tugas:</label>
                    <span id="tanggal_surat_tugas"><?php echo htmlspecialchars($tanggal_surat_tugas, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            </div>

            <div class="dosen-pembimbing">
                <h3>Dosen Pembimbing</h3>
                <div>
                    <label for="nama">Nama:</label>
                    <span id="nama"><?php echo htmlspecialchars($row['dosen_pembimbing'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="nip">NIP:</label>
                    <span id="nip"><?php echo htmlspecialchars($row['nip'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            </div>

            <div class="anggota">
                <h3>Mahasiswa</h3>
                <div>
                    <label for="nama">Nama:</label>
                    <span id="nama"><?php echo htmlspecialchars($row['mahasiswa'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="nim">NIM:</label>
                    <span id="nim"><?php echo htmlspecialchars($row['nim'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div>
                    <label for="prodi">Program Studi:</label>
                    <span id="prodi"><?php echo htmlspecialchars($row['prodi'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            </div>

            <div class="Lampiran">
                <div class="file-upload">
                    <label for="surat-tugas">Surat Tugas</label>
                    <img src="Asset/img icon.jpg" alt="Placeholder">
                </div>
                <div class="file-upload">
                    <label for="surat-tugas">File Sertifikat</label>
                    <img src="Asset/img icon.jpg" alt="Placeholder">
                </div>
            </div>

            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_kompetisi'], ENT_QUOTES, 'UTF-8'); ?>">
                <button style="
            display: inline-block;
            background-color: #2D2669;
            color: #fff;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        " type="submit" name="validate" class="validate-btn">Validasi</button>
            </form>
        </div>
    </div>
</body>
</html>
