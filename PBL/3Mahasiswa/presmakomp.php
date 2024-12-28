<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa Dashboard</title>
    <?php
    require_once 'Backend/tampil_inputdata.php';
    ?>
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

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: rgba(30, 58, 138, 0.5);
            backdrop-filter: blur(10px);
            padding: 24px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 24px;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        .username {
            color: white;
            font-size: 1.1rem;
            flex-grow: 1;
        }

        #logout-button {
            background: #FF4C4C; 
            color: white;
            text-align: center;
            font-weight: bold;
            transition: background 0.3s ease;

            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            margin: 10px 0;
            background: white;
            border-radius: 5px;
            color: #2D2669;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }


        .menu-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Main Content Styles */
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
            text-shadow: 2px 2px 4px rgba(43, 35, 88, 0.7);
        }

        .linkPrestasi {
            color: white;
            font-weight: bold;
            font-size: 22px;
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

        .section-title {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 24px;
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
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 4px;
        }

        .status {
            color: white;
            font-size: 1.25rem;
        }

        .input-prestasi {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: #1e3a8a;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .input-prestasi:hover {
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-profile">
            <div class="user-avatar"></div>
            <span class="username">Username</span>
        </div>
        
        <a href="dashboard.php" class="menu-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#2D2669"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg>
            Beranda
        </a>

        <a href="presmakomp.php" class="menu-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#2D2669"><path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 16H5V5h14v14z"/><path d="m13.293 6.293-4 4-2.293-2.293-1.414 1.414L8.293 12l1.414 1.414L14 8.414l4.293 4.293 1.414-1.414L13.293 6.293z"/></svg>
            Prestasi Mahasiswa
        </a>

        <a href="agendakomp.php" class="menu-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#2D2669"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/><path d="M11 11h2v6h-2zm0-4h2v2h-2z"/></svg>
            Agenda Kompetisi
        </a>

        <a href="rankpres.php" class="menu-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#2D2669"><path d="M20 12a8 8 0 0 0-8-8v8l5.657 5.657A7.95 7.95 0 0 0 20 12z"/><path d="M12 4a8 8 0 0 0 0 16 8 8 0 0 0 0-16zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12z"/></svg>
            Rangking Prestasi
        </a>
        <a href="../0Loginpage/login.html" id="logout-button" class="menu-item hidden">Keluar</a>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Prestasi Mahasiswa</h1>
            <div class="page-nav">
                <div class="page-nav">
                <a href="presmakomp.php" class="linkKompetisi">Kompetisi</a>
                    <span>|</span>
                    <a href="presmapres.php" class="linkPrestasi">Prestasi</a>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Menunggu Validasi</h2>
                  <!-- Tampilkan data kompetisi -->
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
                              <?php echo $row['skor'] !== null ? htmlspecialchars($row['skor']) : '-'; ?>
                          </div>
                          <div class="status">Proses Validasi</div>
                      </div>
                  </div>
              <?php endwhile; ?>

            
            <a href="InputPrestasi.php" class="input-prestasi">
                <span>+</span>
                <span>Data Baru</span>
            </a>
        </div>
    </div>
</body>
</html> 