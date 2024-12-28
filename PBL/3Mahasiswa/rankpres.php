<?php
$results = $_SESSION['ranking_results'] ?? []; // Ambil data dari session
unset($_SESSION['ranking_results']); // Hapus session setelah digunakan
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Ranking Dashboard</title>
    <?php
    require_once 'Backend/tampil_rankpres.php';
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
            background-image: url(../Asset/Background\ landscape.png);
            background-size: cover;
            background-position: center;
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


        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            margin: 10px 0;
            background: white;
            border-radius: 8px;
            color: #2D2669;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 32px;
        }

        .header-image {
            width: 100%;
            height: 250px;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 32px;
        }

        .header-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ranking-section {
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 32px;
            border: 2px solid white;
        }

        .section-title {
            color: white;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 32px;
        }

        .ranking-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.31);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 16px;
            transition: background-color 0.3s ease;
        }

        .ranking-card:hover {
            background: rgba(59, 130, 246, 0.4);
        }

        .rank-info {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .rank-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
        }

        .student-info {
            color: white;
        }

        .student-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .student-details {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .score {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
        }

        .menu-icon {
            width: 24px;
            height: 24px;
            fill: #2D2669;
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
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
            </svg>
            Beranda
        </a>

        <a href="presmakomp.php" class="menu-item">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 16H5V5h14v14z"/>
                <path d="m13.293 6.293-4 4-2.293-2.293-1.414 1.414L8.293 12l1.414 1.414L14 8.414l4.293 4.293 1.414-1.414L13.293 6.293z"/>
            </svg>
            Prestasi Mahasiswa
        </a>

        <a href="agendakomp.php" class="menu-item">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/>
                <path d="M11 11h2v6h-2zm0-4h2v2h-2z"/>
            </svg>
            Agenda Kompetisi
        </a>

        <a href="rankpres.php" class="menu-item">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M20 12a8 8 0 0 0-8-8v8l5.657 5.657A7.95 7.95 0 0 0 20 12z"/>
                <path d="M12 4a8 8 0 0 0 0 16 8 8 0 0 0 0-16zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12z"/>
            </svg>
            Rangking Prestasi
        </a>

        <a href="../0Loginpage/login.html" id="logout-button" class="menu-item hidden">Keluar</a>
    </div>

    <div class="main-content">
        <div class="header-image">
            <img src="../Asset/Piala ranking.png" alt="Trophy and medals">
        </div>

        <!--loop for show rankpres-->
        <div class="ranking-section">
            <h2 class="section-title">Ranking</h2>
        
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $row): ?>
                    <div class="ranking-card">
                        <div class="rank-info">
                            <div class="rank-number"><?php echo $row['Ranking']; ?></div>
                            <div class="student-info">
                                <div class="student-name"><?php echo htmlspecialchars($row['Nama']); ?></div>
                            </div>
                        </div>
                        <div class="score"><?php echo $row['skor']; ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: white; text-align: center;">Tidak ada data ranking tersedia.</p>
            <?php endif; ?>

            <?php unset($_SESSION['ranking_results']); ?>
        </div>
    </div>
</body>
</html>