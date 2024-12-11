<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=8.0">
    <title>Pendataan Lomba</title>
    <link rel="stylesheet" type="text/css" href="TambahAgendaStyle.css">

    <script>
        // Fungsi untuk menandai menu yang aktif
    function setActiveMenu(menuId) {
        // Hapus kelas 'active' dari semua menu item
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => item.classList.remove('active'));
        
        // Tambahkan kelas 'active' pada menu item yang dipilih
        document.getElementById(menuId).classList.add('active');
    }

    function setActiveMenu(menuId) {
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => item.classList.remove('active'));
        document.getElementById(menuId).classList.add('active');
    }

    

    document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.getElementById("file-upload");
            const fileNameSpan = document.getElementById("file-name");

            fileInput.addEventListener("change", function () {
                const file = fileInput.files[0]; // File yang dipilih oleh pengguna

                if (file) {
                    // Tampilkan nama file
                    fileNameSpan.textContent = file.name;
                    fileNameSpan.style.color = "#2D2669"; // Warna file yang sudah dipilih
                } else {
                    // Kembali ke default jika tidak ada file
                    fileNameSpan.textContent = "No file selected";
                    fileNameSpan.style.color = "#555";
                }
            });
        })
</script>
</head>
<body>
    <div class="sidebar">
        <div class="user-profile">
            <div class="user-avatar"></div>
            <span class="username">Username</span>
            <span class="collapse-arrow">≪</span>
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
    </div>

    <div class="main-content">
        
        <div id="box">
            <div id="box1">
                <h1 class="welcome-text">Pendataan Lomba</h1>
            </div>
            <form class="competition-form" action="backend/submit_info.php" method="POST">
                <!-- Judul Lomba -->
                <div class="form-group2">
                    <div class="form"></div>
                    <div class="form-group">
                        <label for="judul-lomba">Judul Lomba :</label>
                        <input type="text" id="judul-lomba" name="judul-lomba" placeholder="Masukkan Judul Lomba" required/>
                    </div>
            
                    <div class="form-group">
                        <label for="url-lomba">URL Lomba :</label>
                        <input type="url" id="url-lomba" name="url-lomba" placeholder="Masukkan URL Lomba" required />
                    </div>
            
                    <div class="form-upload">
                        <label for="file-upload" class="custom-file-upload">
                            Upload Thumbnail
                        </label>
                        <input type="file" id="file-upload" name="file-upload" accept="" style="display: none;" />
                        <span class="file-name" id="file-name">No file selected</span>
                    </div>
                </div>
            
                <!-- Tanggal Mulai dan Berakhir -->
                <div class="form-group1">
                    <div>
                        <label for="tanggal-mulai">Tanggal Mulai :</label>
                        <input type="date" id="tanggal-mulai" name="tanggal-mulai" required />
                    </div>
                    <div>
                        <label for="tanggal-berakhir">Tanggal Berakhir :</label>
                        <input type="date" id="tanggal-berakhir" name="tanggal-berakhir" required />
                    </div>
                </div>
            
                <!-- Deskripsi Lomba -->
                <div class="form-group">
                    <label for="deskripsi-lomba">Deskripsi Lomba :</label>
                    <input type="text" id="deskripsi-lomba" name="deskripsi-lomba" placeholder="Masukkan Deskripsi Lomba" required />
                </div>
            
                <!-- Tombol Tambah -->
                <button type="submit" class="btn-submit">Tambah</button>
            </form>
            
        </div>
        
        <!-- Form Pendataan Lomba -->
        
    </div>
</body>
</html>