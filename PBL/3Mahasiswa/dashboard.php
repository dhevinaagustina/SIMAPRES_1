<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            background-image:url(../Asset/Background\ landscape.png);
            background-attachment: fixed;
            
        }

        .main-content {
            flex: 1;
            padding: 40px;
        }

        .welcome-text {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .section-title {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .competition-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .competition-image {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 20px;
        }

        .competition-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .competition-image input[type="file"] {
            display: none;
        }

        .competition-image label {
            display: block;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .competition-info {
            flex: 1;
        }

        .competition-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .competition-title {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .competition-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .competition-date {
            color: white;
            margin-bottom: 8px;
            text-align: right;
        }

        .competition-link {
            background: white;
            color: #1e3a8a;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .competition-link:hover {
            background: rgb(255, 255, 255, 0.3 );
            transform: translateY(-2px);
        }

        .right-content {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
    </style>
</head>
<body>
    <?php Sidebar::render(); //modularitas, memanggil sidebar?>

    </div>
    <div class="main-content">
        <h1 class="welcome-text">Selamat Datang! Mahasiswa</h1>
        <h2 class="section-title">Seputar Kompetisi</h2>
        
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
            $image_url = isset($row['FotoThumbnail']) ? $row['FotoThumbnail'] : '/path/to/placeholder.jpg'; // Ganti dengan URL gambar default jika kosong
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
                        <img src="<?php echo $image_url; ?>" alt="Competition Image">
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
    </div>

</body>
</html>