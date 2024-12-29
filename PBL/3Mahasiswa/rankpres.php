<?php
$results = $_SESSION['ranking_results'] ?? []; // Ambil data dari session
unset($_SESSION['ranking_results']); // Hapus session setelah digunakan
require_once 'Backend/tampil_rankpres.php';
require_once 'Sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Ranking Dashboard</title>
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
    <?php Sidebar::render(); //modularitas, memanggil sidebar?>

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