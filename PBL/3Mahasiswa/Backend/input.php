<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nama_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses input data kompetisi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Data Kompetisi
    $prodi = $_POST['prodi'];
    $jenis_kompetisi = $_POST['jenis-kompetisi'];
    $tingkat_kompetisi = $_POST['tingkat-kompetisi'];
    $judul_kompetisi = $_POST['judul-kompetisi'];
    $judul_kompetisi_eng = $_POST['judul-kompetisi-eng'];
    $tempat_kompetisi = $_POST['tempat-kompetisi'];
    $tempat_kompetisi_eng = $_POST['tempat-kompetisi-eng'];
    $url_kompetisi = $_POST['url-kompetisi'];
    $tanggal_mulai = $_POST['tanggal-mulai'];
    $tanggal_akhir = $_POST['tanggal-akhir'];
    $jumlah_pt = $_POST['jumlah-pt'];
    $jumlah_peserta = $_POST['jumlah-peserta'];
    $no_surat = $_POST['no-surat'];
    $tanggal_surat = $_POST['tanggal-surat'];

    // Upload file
    $uploadDir = "uploads/";
    $file_surat = $uploadDir . basename($_FILES["file-surat"]["name"]);
    $foto_kegiatan = $uploadDir . basename($_FILES["foto-kegiatan"]["name"]);
    $file_sertifikat = $uploadDir . basename($_FILES["file-sertifikat"]["name"]);
    $file_poster = $uploadDir . basename($_FILES["file-poster"]["name"]);

    move_uploaded_file($_FILES["file-surat"]["tmp_name"], $file_surat);
    move_uploaded_file($_FILES["foto-kegiatan"]["tmp_name"], $foto_kegiatan);
    move_uploaded_file($_FILES["file-sertifikat"]["tmp_name"], $file_sertifikat);
    move_uploaded_file($_FILES["file-poster"]["tmp_name"], $file_poster);

    // Simpan data ke tabel kompetisi
    $stmt = $conn->prepare("
        INSERT INTO kompetisi (prodi, jenis_kompetisi, tingkat_kompetisi, judul_kompetisi, judul_kompetisi_eng, tempat_kompetisi, tempat_kompetisi_eng, url_kompetisi, tanggal_mulai, tanggal_akhir, jumlah_pt, jumlah_peserta, no_surat_tugas, tanggal_surat, file_surat, foto_kegiatan, file_sertifikat, file_poster)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "ssssssssssiisssss",
        $prodi, $jenis_kompetisi, $tingkat_kompetisi, $judul_kompetisi, $judul_kompetisi_eng, $tempat_kompetisi, $tempat_kompetisi_eng, $url_kompetisi, $tanggal_mulai, $tanggal_akhir, $jumlah_pt, $jumlah_peserta, $no_surat, $tanggal_surat, $file_surat, $foto_kegiatan, $file_sertifikat, $file_poster
    );
    $stmt->execute();
    $kompetisi_id = $stmt->insert_id;

    // Data Mahasiswa
    foreach ($_POST['mahasiswa'] as $index => $mahasiswa) {
        $peran = $_POST['peran_mahasiswa'][$index];
        $stmt = $conn->prepare("INSERT INTO mahasiswa (kompetisi_id, nama_mahasiswa, peran) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $kompetisi_id, $mahasiswa, $peran);
        $stmt->execute();
    }

    // Data Pembimbing
    foreach ($_POST['pembimbing'] as $index => $pembimbing) {
        $peran_pembimbing = $_POST['peran_pembimbing'][$index];
        $stmt = $conn->prepare("INSERT INTO pembimbing (kompetisi_id, nama_pembimbing, peran) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $kompetisi_id, $pembimbing, $peran_pembimbing);
        $stmt->execute();
    }

    echo "Data berhasil disimpan!";
}
?>
