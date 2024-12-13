<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php
    require_once 'backend/tampil_info.php';
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
        .double-arrow {
            position: absolute;
            right: 0;
            color: white;
            font-size: 20px;
        }

    

        .username {
            color: white;
            font-size: 1.1rem;
            flex-grow: 1;
        }

        .collapse-arrow {
            color: white;
            font-size: 1.5rem;
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

        <a href="rankpres.html" class="menu-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#2D2669"><path d="M20 12a8 8 0 0 0-8-8v8l5.657 5.657A7.95 7.95 0 0 0 20 12z"/><path d="M12 4a8 8 0 0 0 0 16 8 8 0 0 0 0-16zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12z"/></svg>
            Rangking Prestasi
        </a>

        <a href="../0Loginpage/login.html" id="logout-button" class="menu-item hidden">Keluar</a>
    </div>

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