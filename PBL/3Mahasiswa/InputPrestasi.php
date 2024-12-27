<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Prestasi</title>
    <link rel="stylesheet" type="text/css" href="InputPrestasi.css">
    <?php
    include_once 'Backend/datamhs.php'; //input nama pada tabel data mahasiswa
    ?>
    <script>
    function previewFile(input, previewId, filenameId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);
        const filename = document.getElementById(filenameId);

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Jika file adalah gambar, tampilkan di elemen <img>
                if (file.type.startsWith("image/")) {
                    preview.src = e.target.result;
                } else {
                    preview.src = "Asset/img icon.jpg"; // Placeholder default untuk non-gambar
                }
            };
            reader.readAsDataURL(file);

            // Tampilkan nama file
            filename.textContent = file.name;
        } else {
            preview.src = "Asset/img icon.jpg"; // Kembali ke placeholder jika tidak ada file
            filename.textContent = "Ukuran (Max: 5000KB)<br>Ekstensi (jpg, jpeg, png, pdf, docx)";
        }
    }

    </script>
</head>
<body>
    <div class="sidebar">
        <div class="user-profile">
            <div class="user-avatar"></div>
            <span class="username">Username</span>
            <span class="collapse-arrow">≪</span>
        </div>
        
        <a href="dashboard.php" class="menu-item">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
            </svg>
            Beranda
        </a>

        <a href="presmakomp.html" class="menu-item">
            <svg class="menu-icon" viewBox="0 0 24 24">
                <path d="M20 12a8 8 0 0 0-8-8v8l5.657 5.657A7.95 7.95 0 0 0 20 12z"/>
                <path d="M12 4a8 8 0 0 0 0 16 8 8 0 0 0 0-16zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12z"/>
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
                <path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 16H5V5h14v14z"/>
                <path d="m13.293 6.293-4 4-2.293-2.293-1.414 1.414L8.293 12l1.414 1.414L14 8.414l4.293 4.293 1.414-1.414L13.293 6.293z"/>
            </svg>
            Peringkat mahasiswa
        </a>
    </div>


    <div class="main-content">
        <div class="box1">
            <h1 class="welcome-text">Data Kompetisi</h1>
        </div>
        
    <div class="data">
    <form class="pendataan" action="Backend/input.php" method="POST" enctype="multipart/form-data">
        <div class="form">
            <label for="program_studi">Program Studi</label>
            <input list="program_studi-options" id="program_studi" name="program_studi">
            <datalist id="program_studi-options">
                <option value="Teknik Informatika">
                <option value="Sistem Informasi">
            </datalist>
        </div>

        <div class="form">
            <label for="jenis_kompetisi">Jenis Kompetisi</label>
            <input list="jenis" id="jenis_kompetisi" name="jenis_kompetisi">
            <datalist id="jenis">
                <option value="Akademik">
                <option value="Non Akademik">
            </datalist>
        </div>
                
        <div class="form">
            <label for="tingkat_kompetisi">Tingkat Kompetisi</label>
            <input list="tingkat" type="text" id="tingkat_kompetisi" name="tingkat_kompetisi">
            <datalist id="tingkat">
                <option value="Internasional"></option>
                <option value="Nasional"></option>
            </datalist>
        </div>

            <div class="form">
            <label for="dosen_pembimbing">Dosen Pembimbing</label>
            <input list="dosen-options" id="dosen_pembimbing" name="dosen_pembimbing">
            <datalist id="dosen-options">
                <?php foreach ($options_dosen as $dosen): ?>
                    <option value="<?php echo htmlspecialchars($dosen['nama']); ?>">
                        <?php echo htmlspecialchars($dosen['nama']); ?> (<?php echo htmlspecialchars($dosen['nip']); ?>)
                    </option>
                <?php endforeach; ?>
            </datalist>
        </div>

        <div class="form">
            <label for="mahasiswa">Nama Mahasiswa</label>
            <input list="mahasiswa-options" id="mahasiswa" name="mahasiswa">
            <datalist id="mahasiswa-options">
                <?php foreach ($options_mahasiswa as $mahasiswa): ?>
                    <option value="<?php echo htmlspecialchars($mahasiswa['nama']); ?>">
                        <?php echo htmlspecialchars($mahasiswa['nama']); ?> (<?php echo htmlspecialchars($mahasiswa['nim']); ?>)
                    </option>
                <?php endforeach; ?>
            </datalist>
        </div>


        <div class="form">
            <label for="judul_kompetisi">Judul Kompetisi</label>
            <input type="text" id="judul_kompetisi" name="judul_kompetisi">
        </div>

        <div class="form">
            <label for="judul_kompetisi_english">Judul Kompetisi (English)</label>
            <input type="text" id="judul_kompetisi_english" name="judul_kompetisi_english">
        </div>

        <div class="form">
            <label for="tempat_kompetisi">Tempat Kompetisi</label>
            <input type="text" id="tempat_kompetisi" name="tempat_kompetisi">
        </div>

        <div class="form">
            <label for="tempat_kompetisi_english">Tempat Kompetisi (English)</label>
            <input type="text" id="tempat_kompetisi_english" name="tempat_kompetisi_english">
        </div>

        <div class="form">
            <label for="url_kompetisi">URL Kompetisi</label>
            <input type="text" id="url_kompetisi" name="url_kompetisi">
        </div>

        <div class="form">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai">
        </div>

        <div class="form">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir">
        </div>

        <div class="form">
            <label for="jumlah_pt">Jumlah PT (Berpartisipasi)</label>
            <input type="text" id="jumlah_pt" name="jumlah_pt">
        </div>

        <div class="form">
            <label for="jumlah_peserta">Jumlah Peserta</label>
            <input type="text" id="jumlah_peserta" name="jumlah_peserta">
        </div>

        <div class="form">
            <label for="no_surat_tugas">No Surat Tugas</label>
            <input type="text" id="no_surat_tugas" name="no_surat_tugas">
        </div>

        <div class="form">
            <label for="tanggal_surat_tugas">Tanggal Surat Tugas</label>
            <input type="date" id="tanggal_surat_tugas" name="tanggal_surat_tugas">
        </div>

        <!-- Form untuk upload file -->
        <div class="file-section">
            <div class="file-item">
                <label>File Surat Tugas</label>
                <div class="file-upload">
                    <img src="Asset/img icon.jpg" alt="Placeholder" id="preview-surat">
                    <p>Ukuran (Max: 5000KB)<br>Ekstensi (jpg, jpeg, png, pdf, docx)</p>
                    <input type="file" id="file-upload" class="custom-file-input" accept=".jpg, .jpeg, .png, .pdf, .docx" onchange="previewFile(this, 'preview-surat', 'filename-surat')">
                </div>
            </div>

            <div class="file-item">
                <label>Foto Kegiatan</label>
                <div class="file-upload">
                    <img src="Asset/img icon.jpg" alt="Placeholder" id="preview-kegiatan">
                    <p>Ukuran (Max: 5000KB)<br>Ekstensi (jpg, jpeg, png, pdf, docx)</p>
                    <input type="file" id="file-upload" class="custom-file-input" accept=".jpg, .jpeg, .png, .pdf, .docx" onchange="previewFile(this, 'preview-kegiatan', 'filename-kegiatan')">
                </div>
            </div>

            <div class="file-item">
                <label>File Sertifikat</label>
                <div class="file-upload">
                    <img src="Asset/img icon.jpg" alt="Placeholder" id="preview-sertifikat">
                    <p>Ukuran (Max: 5000KB)<br>Ekstensi (jpg, jpeg, png, pdf, docx)</p>
                    <input type="file" id="file-upload" class="custom-file-input" accept=".jpg, .jpeg, .png, .pdf, .docx" onchange="previewFile(this, 'preview-sertifikat', 'filename-sertifikat')">
                </div>
            </div>

            <div class="file-item">
                <label>File Poster</label>
                <div class="file-upload">
                    <img src="Asset/img icon.jpg" alt="Placeholder" id="preview-poster">
                    <p>Ukuran (Max: 5000KB)<br>Ekstensi (jpg, jpeg, png, pdf, docx)</p>
                    <input type="file" id="file-upload" class="custom-file-input" accept=".jpg, .jpeg, .png, .pdf, .docx" onchange="previewFile(this, 'preview-poster', 'filename-poster')">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="presmakomp.php">   
            <button onclick="" type="submit" id="simpan-data">Simpan</button>
            </a>
        </div>
    </form>
</div>
</div>
</body>
</html>
