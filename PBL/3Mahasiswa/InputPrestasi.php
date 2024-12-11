<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Prestasi</title>
    <link rel="stylesheet" type="text/css" href="InputPrestasi.css">
    <?php
    include_once 'Backend/datamhs.php';//input nama pada tabel data mahasiswa
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

document.addEventListener("DOMContentLoaded", function () {
    // Fungsi untuk menambahkan baris baru ke tabel
    function tambahBaris(tabelId) {
        const table = document.getElementById(tabelId);
        const tbody = table.querySelector("tbody");
        const rowCount = tbody.rows.length;
        const newRow = tbody.insertRow();

        // Tambahkan sel dan isinya
        newRow.innerHTML = `
            <td>${rowCount + 1}</td>
            <td>
                <input list="${tabelId === "mahasiswa-table" ? "nama-mahasiswa" : "nama-dosen"}" type="text" name="${tabelId === "mahasiswa-table" ? "mahasiswa" : "dosen"}">
            </td>
            <td>
                <select>
                    <option>Pilih Peran</option>
                    ${tabelId === "mahasiswa-table" ? `
                    <option>Ketua</option>
                    <option>Anggota</option>
                    <option>Personal</option>` : `
                    <option>Melakukan pembinaan kegiatan mahasiswa di bidang akademik (PA)</option>
                    <option>Membimbing mahasiswa menghasilkan produk saintifik (Nasional)</option>
                    <option>Membimbing mahasiswa menghasilkan produk saintifik (Internasional)</option>
                    <option>Membimbing mahasiswa mengikuti kompetisi akademik (Nasional)</option>
                    <option>Membimbing mahasiswa mengikuti kompetisi akademik (Internasional)</option>`}
                </select>
            </td>
            <td><button class="hapus-baris">❌</button></td>
        `;

        // Tambahkan event listener ke tombol hapus
        newRow.querySelector(".hapus-baris").addEventListener("click", function () {
            newRow.remove();
        });
    }

    // Tambahkan event listener untuk tombol "+ Tambah"
    document.getElementById("tambah-mahasiswa").addEventListener("click", function () {
        tambahBaris("mahasiswa-table");
    });

    document.getElementById("tambah-pembimbing").addEventListener("click", function () {
        tambahBaris("pembimbing-table");
    });

    // Event listener untuk tombol hapus pada baris awal
    document.querySelectorAll(".hapus-baris").forEach(button => {
        button.addEventListener("click", function () {
            button.closest("tr").remove();
        });
    });
});

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

        <a href="rankpres.html" class="menu-item">
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
        <form class="pendataan" action="Backend/input.php">
                <div class="form">
                    <label for="prodi">Program Studi:</label>
                    <input list="prodi-options" id="prodi" name="prodi">
                    <datalist id="prodi-options">
                        <option value="Teknik Informatika">
                        <option value="Sistem Informasi">
                    </datalist>
                    
                </div>

                <div class="form">
                    <label for="prodi">Jenis Kompetisi </label>
                    <input list="jenis" type="text" id="jenis-kompetisi" name="jenis-kompetisi">
                    <datalist id="jenis">
                        <option value="Akademik">
                        <option value="Non Akademik">
                    </datalist>
                </div>
                
                <div class="form">
                    <label for="Kompetisi">Tingkat Kompetisi </label>
                    <input list="tingkat" type="text" id="tingkat-kompetisi" name="tingkat-kompetisi">
                    <datalist id="tingkat">
                        <option value="Internasional"></option>
                        <option value="Nasional"></option>
                    </datalist>
                </div>

                <div class="form">
                    <label for="Kompetisi">Judul Kompetisi </label>
                    <input type="text" id="judul-kompetisi" name="judul-kompetisi">
                </div>

                <div class="form">
                    <label for="Kompetisi">Judul Kompetisi (English) </label>
                    <input type="text" id="judul-kompetisi" name="judul-kompetisi">
                </div>

                <div class="form">
                    <label for="Kompetisi">Tempat Kompetisi </label>
                    <input type="text" id="tempat-kompetisi" name="tempat-kompetisi">
                </div>

                <div class="form">
                    <label for="Kompetisi">Tempat Kompetisi (English) </label>
                    <input type="text" id="tempat-kompetisi" name="tempat-kompetisi">
                </div>

                <div class="form">
                    <label for="Kompetisi">URL Kompetisi </label>
                    <input type="text" id="url-kompetisi" name="url-kompetisi">
                </div>

                <div class="form">
                    <label for="Kompetisi">Tanggal Mulai </label>
                    <input type="date" id="tanggal" name="tanggal">
                </div>

                <div class="form">
                    <label for="Kompetisi">Tanggal Akhir </label>
                    <input type="date" id="tanggal" name="tanggal">
                </div>

                <div class="form">
                    <label for="Kompetisi">Jumlah PT (Berpartisipasi)</label>
                    <input type="text" id="tanggal" name="tanggal">
                </div>

                <div class="form">
                    <label for="Kompetisi">Jumlah Peserta </label>
                    <input type="text" id="Peserta" name="peserta">
                </div>

                <div class="form">
                    <label for="Kompetisi">No Surat Tugas </label>
                    <input type="text" id="surat" name="surat">
                </div>

                <div class="form">
                    <label for="Kompetisi">Tanggal Surat Tugas </label>
                    <input type="text" id="Tanggal" name="Tanggal">
                </div>
            </form>
            <div class="data">
                <!-- Form untuk file -->
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
            
                <!-- Data Mahasiswa -->
                <div class="table-section">
    <h2>Data Mahasiswa</h2>
    <table id="mahasiswa-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Mahasiswa</th>
                <th>Peran Mahasiswa</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    <input list="nama-mahasiswa" type="text" name="mahasiswa">
                    <datalist id="nama-mahasiswa">
                        <?php 
                        if (!empty($options_mahasiswa)) {
                            foreach ($options_mahasiswa as $option): ?>
                                <option value="<?php echo htmlspecialchars($option['nama']); ?>"><?php echo htmlspecialchars($option['nim']); ?></option>
                        <?php endforeach; 
                        } else {
                            echo "<option value=''>Tidak ada data mahasiswa</option>";
                        }
                        ?>
                    </datalist>
                </td>
                <td>
                    <select>
                        <option>Pilih Peran</option>
                        <option>Ketua</option>
                        <option>Anggota</option>
                        <option>Personal</option>
                    </select>
                </td>
                <td><button class="hapus-baris">❌</button></td>
            </tr>
        </tbody>
    </table>
    <button id="tambah-mahasiswa">+ Tambah</button>
</div>

<!-- Data Pembimbing -->
<div class="table-section">
    <h2>Data Pembimbing</h2>
    <table id="pembimbing-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Pembimbing</th>
                <th>Peran Pembimbing</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><input list="nama-dosen" type="text" name="dosen">
                    <datalist id="nama-dosen">
                        <?php 
                        if (!empty($options_dosen)) {
                            foreach ($options_dosen as $option): ?>
                                <option value="<?php echo htmlspecialchars($option['nama']); ?>"><?php echo htmlspecialchars($option['nip']); ?></option>
                        <?php endforeach; 
                        } else {
                            echo "<option value=''>Tidak ada data dosen</option>";
                        }
                        ?>
                    </datalist>
                </td>
                <td>
                    <select>
                        <option>Pilih Peran</option>
                        <option>Melakukan pembinaan kegiatan mahasiswa di bidang akademik (PA)</option>
                        <option>Membimbing mahasiswa menghasilkan produk saintifik (Nasional)</option>
                        <option>Membimbing mahasiswa menghasilkan produk saintifik (Internasional)</option>
                        <option>Membimbing mahasiswa mengikuti kompetisi akademik (Nasional)</option>
                        <option>Membimbing mahasiswa mengikuti kompetisi akademik (Internasional)</option>
                    </select>
                </td>
                <td><button class="hapus-baris">❌</button></td>
            </tr>
        </tbody>
    </table>
    <button id="tambah-pembimbing">+ Tambah</button>
</div>
            </div>            
        </div>
    </div>

</body>
</html>