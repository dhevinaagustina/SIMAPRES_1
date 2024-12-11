<?php
session_start();
require 'konek.php';

$conn = connectToDatabase("DESKTOP-EJT421I\DBMS2024", "PBL_DB");

if (!$conn) {
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
}

// Fungsi validasi file yang diperbaiki
function validateFileUpload($file, $uploadDir, $allowedTypes, $maxSize) {
    // Periksa apakah file benar-benar diunggah
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null; // Kembalikan null jika tidak ada file yang diupload
    }

    $filePath = $uploadDir . basename($file["name"]);
    $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedTypes)) {
        throw new Exception("File " . $file["name"] . " tidak valid. Ekstensi file harus jpg, jpeg, png, pdf, atau docx.");
    }

    if ($file["size"] > $maxSize) {
        throw new Exception("File " . $file["name"] . " terlalu besar. Maksimal ukuran file adalah 5MB.");
    }

    return $filePath;
}

$uploadDir = "uploads/";
$allowedTypes = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
$maxSize = 5000000; // 5MB

try {
    // Menangani upload file dengan pemeriksaan null
    $file_surat = isset($_FILES["file_surat_tugas"]) ? 
        validateFileUpload($_FILES["file_surat_tugas"], $uploadDir, $allowedTypes, $maxSize) : null;
    
    $foto_kegiatan = isset($_FILES["file_kegiatan"]) ? 
        validateFileUpload($_FILES["file_kegiatan"], $uploadDir, $allowedTypes, $maxSize) : null;
    
    $file_sertifikat = isset($_FILES["file_sertifikat"]) ? 
        validateFileUpload($_FILES["file_sertifikat"], $uploadDir, $allowedTypes, $maxSize) : null;
    
    $file_poster = isset($_FILES["file_poster"]) ? 
        validateFileUpload($_FILES["file_poster"], $uploadDir, $allowedTypes, $maxSize) : null;

    // Pastikan direktori unggahan ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

   // Menangani upload file dengan pemeriksaan null
$uploadedFiles = [];
$fileFields = [
    'file_surat_tugas' => $_FILES["file_surat_tugas"] ?? null,
    'foto_kegiatan' => $_FILES["foto_kegiatan"] ?? null,
    'file_sertifikat' => $_FILES["file_sertifikat"] ?? null,
    'file_poster' => $_FILES["file_poster"] ?? null
];

foreach ($fileFields as $key => $file) {
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $targetPath = $uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $uploadedFiles[$key] = $targetPath;
        }
    } else {
        // Jika file tidak diunggah, set ke string kosong atau nilai default
        $uploadedFiles[$key] = ''; 
    }
}

// Kode query
$sql = "INSERT INTO presma.Kompetisi (
    program_studi, jenis_kompetisi, tingkat_kompetisi, 
    judul_kompetisi, judul_kompetisi_english, 
    tempat_kompetisi, tempat_kompetisi_english, 
    url_kompetisi, tanggal_mulai, tanggal_akhir, 
    jumlah_pt, jumlah_peserta, no_surat_tugas, 
    tanggal_surat_tugas, file_surat_tugas, foto_kegiatan, 
    file_sertifikat, file_poster
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$params = [
    $_POST['program_studi'], $_POST['jenis_kompetisi'], $_POST['tingkat_kompetisi'], 
    $_POST['judul_kompetisi'], $_POST['judul_kompetisi_english'], 
    $_POST['tempat_kompetisi'], $_POST['tempat_kompetisi_english'], 
    $_POST['url_kompetisi'], $_POST['tanggal_mulai'], $_POST['tanggal_akhir'], 
    $_POST['jumlah_pt'], $_POST['jumlah_peserta'], $_POST['no_surat_tugas'], 
    $_POST['tanggal_surat_tugas'], 
    $uploadedFiles['file_surat_tugas'], 
    $uploadedFiles['foto_kegiatan'], 
    $uploadedFiles['file_sertifikat'], 
    $uploadedFiles['file_poster']
];

$query = sqlsrv_query($conn, $sql, $params);

if ($query === false) {
    die("Gagal menyimpan data kompetisi: " . print_r(sqlsrv_errors(), true));
}

// Jika berhasil, arahkan ke halaman sukses
header("Location: ../presmakomp.html"); // Ganti dengan URL yang sesuai
exit; // Pastikan untuk menghentikan script setelah redirect

} catch (Exception $e) {
// Menangani error jika ada
die($e->getMessage());
}
?>
