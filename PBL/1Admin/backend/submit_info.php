<?php
session_start();
require 'konek.php';

// Koneksi ke database
$conn = connectToDatabase("DESKTOP-EJT421I\DBMS2024", "PBL_DB");

if (!$conn) {
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judulLomba = $_POST['judul-lomba'];
    $urlLomba = $_POST['url-lomba'];
    $tanggalMulai = DateTime::createFromFormat('Y-m-d', $_POST['tanggal-mulai'])->format('Y-m-d');
    $tanggalSelesai = DateTime::createFromFormat('Y-m-d', $_POST['tanggal-berakhir'])->format('Y-m-d');
    $deskripsiLomba = $_POST['deskripsi-lomba']; // Ambil deskripsi lomba

    // Tentukan lokasi folder untuk menyimpan thumbnail
    $thumbnailDir = 'uploads/thumbnails/';

    // Cek apakah folder sudah ada, jika belum maka buat folder
    if (!is_dir($thumbnailDir)) {
        if (!mkdir($thumbnailDir, 0777, true)) {
            die('Gagal membuat folder untuk menyimpan thumbnail!');
        }
    }

    // Upload file thumbnail jika ada
    $fotoThumbnail = null;
    if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] === UPLOAD_ERR_OK) {
        // Memastikan file adalah gambar dan ukuran file wajar
        $fileType = mime_content_type($_FILES['file-upload']['tmp_name']);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

        if (in_array($fileType, $allowedTypes)) {
            // Tentukan nama file dan path lengkap untuk thumbnail
            $fileName = uniqid('thumb_', true) . '.' . pathinfo($_FILES['file-upload']['name'], PATHINFO_EXTENSION);
            $filePath = $thumbnailDir . $fileName;

            // Pindahkan file gambar ke folder
            if (move_uploaded_file($_FILES['file-upload']['tmp_name'], $filePath)) {
                $fotoThumbnail = $filePath; // Simpan path file gambar
            } else {
                echo "Gagal meng-upload gambar!";
                exit();
            }
        } else {
            echo "Hanya gambar (JPG, PNG) yang diperbolehkan!";
            exit();
        }
    }

    // Jika file tidak diupload, kita bisa kirim gambar default atau NULL
    if ($fotoThumbnail === null) {
        // Kirim gambar default jika tidak ada gambar yang di-upload
        $fotoThumbnail = 'uploads/thumbnails/default_thumbnail.jpg';  // Gambar default
    }

    if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading file: " . $_FILES['file-upload']['error'];
        exit();
    }

    try {
        // Query insert
        $query = "INSERT INTO presma.infoLomba 
            (JudulLomba, UrlLomba, TanggalMulai, TanggalSelesai, DeskripsiLomba, FotoThumbnail)
            VALUES (?, ?, ?, ?, ?, ?)";
        $params = [$judulLomba, $urlLomba, $tanggalMulai, $tanggalSelesai, $deskripsiLomba, $fotoThumbnail];

        // Debugging query dan parameter
        echo "<pre>Query: $query<br>Params:<br>";
        print_r($params);
        echo "</pre>";

        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            die("Kesalahan saat menjalankan query:<br>" . print_r(sqlsrv_errors(), true));
        }

        header("Location: ../agendakomp.php");
        exit();
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
    }
}
