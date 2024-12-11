<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=8.0">
    <title>Beranda</title>
    <link rel="stylesheet" type="text/css" href="BerandaStyle.css">
    <?php
    require_once 'backend/tampil_info.php';
    ?>
    <script>
            // Fungsi untuk menandai menu yang aktif
        function setActiveMenu(menuId) {
            // Hapus kelas 'active' dari semua menu item
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active'));
            
            // Tambahkan kelas 'active' pada menu item yang dipilih
            document.getElementById(menuId).classList.add('active');
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <div class="user-profile">
            <div class="user-avatar"></div>
            <span class="username">Username</span>
            <!--Menghapus arrow dan memindah tombol keluar ke bawah -Nimas,8/12-->
        </div>
        <a href="Beranda.php" class="menu-item" id="menu-beranda" onclick="setActiveMenu('menu-beranda')">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
            </svg>
            Beranda
        </a>

        <a href="TambahAgenda.php" class="menu-item" id="menu-tambah-agenda" onclick="setActiveMenu('menu-tambah-agenda')">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M20 12a8 8 0 0 0-8-8v8l5.657 5.657A7.95 7.95 0 0 0 20 12z"/>
                <path d="M12 4a8 8 0 0 0 0 16 8 8 0 0 0 0-16zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12z"/>
            </svg>
            Tambah Agenda Kompetisi
        </a>

        <a href="agendakomp.php" class="menu-item" id="menu-tambah-agenda" onclick="setActiveMenu('agenda')">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/>
                <path d="M11 11h2v6h-2zm0-4h2v2h-2z"/>
            </svg>
            Agenda Kompetisi
        </a>

        <a href="rankpres.html" class="menu-item" id="menu-tambah-agenda" onclick="setActiveMenu('rank')">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 16H5V5h14v14z"/>
                <path d="m13.293 6.293-4 4-2.293-2.293-1.414 1.414L8.293 12l1.414 1.414L14 8.414l4.293 4.293 1.414-1.414L13.293 6.293z"/>
            </svg>
            Peringkat Mahasiswa
        </a>

        <a href="../0Loginpage/login.html" id="logout-button" class="menu-item hidden">Keluar</a>
    </div>


    <div class="main-content">
        <h1 class="welcome-text">Selamat Datang! Admin</h1>
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

     
</body>
</html>
<!--holaaaaaaaa-->