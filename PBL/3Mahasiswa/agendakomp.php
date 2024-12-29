<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Kompetisi</title>
    <?php
    require_once 'backend/tampil_info.php';
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
            display: flex;
            min-height: 100vh;
            background-image: url(../Asset/Background\ landscape.png);
            background-attachment: fixed;
        }

        .main-content {
            flex: 1;
            padding: 40px;
        }

        .page-title {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-weight: bold;
            text-align: center;
        }

        .search-container {
            margin-bottom: 40px;
            text-align: center  ;
        }

        .search-input {
            width: 70%;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            background: white;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .competition-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 24px;
            transition: transform 0.3s ease;
        }

        .competition-card:hover {
            transform: translateY(-4px);
        }

        .competition-image {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .competition-info {
            flex: 1;
        }

        .competition-title {
            color: white;
            font-size: 1.4rem;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .competition-desc {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            line-height: 1.5;
        }

        .right-content {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }

        .competition-date {
            color: white;
            font-size: 0.9rem;
        }

        .competition-link {
            background: rgba(255, 255, 255, 0.8);
            color: #1e3a8a;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .competition-link:hover {
            background: rgb(255, 255, 255, 0.3 );
        }

        .competition-link svg {
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>
    <?php Sidebar::render(); //modularitas, memanggil sidebar?>

    <div class="main-content">
        <h1 class="page-title">Agenda Kompetisi</h1>
        



        <?php
    if (sqlsrv_has_rows($result)) {
    // Jika ada data, tampilkan
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        // Debug: Lihat isi dari $row
        // var_dump($row); // Anda bisa aktifkan ini sementara untuk debug

        // Periksa apakah kolom ada di dalam $row
        $title = isset($row['JudulLomba']) ? htmlspecialchars($row['JudulLomba']) : 'No Title';
        $description = isset($row['DeskripsiLomba']) ? htmlspecialchars($row['DeskripsiLomba']) : 'No Description';
        $date = isset($row['TanggalMulai']) ? $row['TanggalMulai'] : null;
        $image_url = isset($row['FotoThumbnail']) ? 'backend/uploads/thumbnails/' . $row['FotoThumbnail'] : 'backend/uploads/thumbnails/default_thumbnail.jpg';
        $competition_link = isset($row['UrlLomba']) ? htmlspecialchars($row['UrlLomba']) : '#';

        // Menangani format tanggal
        $formatted_date = '01 January 1970';  // Nilai default jika tanggal kosong
        if ($date instanceof DateTime) {
            // Jika $date adalah objek DateTime, format tanggal langsung
            $formatted_date = $date->format('d F Y');
        } elseif ($date) {
            // Jika $date adalah string atau format lain, gunakan strtotime
            $formatted_date = date('d F Y', strtotime($date));
        }
        ?>
            <div class="competition-card">
                <div class="competition-image">
                <img src="show_image.php?image=<?php echo urlencode($row['FotoThumbnail']); ?>" alt="Competition Image">
                </div>
                <div class="competition-info">
                    <h3 class="competition-title"><?php echo $title; ?></h3>
                    <p class="competition-desc"><?php echo $description; ?></p>
                </div>
                <div class="right-content">
                    <div class="competition-date"><?php echo $formatted_date; ?></div>
                    <a href="<?php echo $competition_link; ?>" class="competition-link">Link Kompetisi</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No agenda found.</p>";  // Jika tidak ada data agenda
    }

    // Menutup koneksi
    sqlsrv_close($conn);
    ?>
    </div>
</body>
</html> 