<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa Dashboard</title>
    <?php
    require_once 'Backend/tampil_inputdata.php';
    require_once 'Sidebar.php';
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
    <?php Sidebar::render(); //modularitas, memanggil sidebar?>

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