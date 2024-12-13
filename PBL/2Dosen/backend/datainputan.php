<?php
// Validasi.php
// Pastikan Anda sudah melakukan koneksi ke database
require_once 'backend/ctgvalidasi.php';

// Mengecek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id_kompetisi = $_GET['id'];

   // Query untuk mengambil data kompetisi, mahasiswa, dan dosen
$query = "
        SELECT 
            k.id_kompetisi, 
            k.judul_kompetisi, 
            k.url_kompetisi, 
            k.tempat_kompetisi, 
            k.tanggal_mulai, 
            k.tanggal_akhir,
            k.jumlah_pt, 
            k.no_surat_tugas,
            k.tanggal_surat_tugas,
            m.nama AS nama_mahasiswa, 
            m.nim AS nim_mahasiswa,
            d.nama AS nama_dosen, 
            d.nip AS nip_dosen
        FROM 
            presma.Kompetisi k
        LEFT JOIN 
            presma.Mahasiswa m ON k.nim = m.nim
        LEFT JOIN 
            presma.Dosen d ON k.nip = d.nip
        WHERE 
            k.id_kompetisi = ?";

        $params = array($id_kompetisi);
        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Jika query gagal
        }

        // Mengambil data dari query
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($row) {
        // Menampilkan data kompetisi
       
        } else {
        echo "<p>Data tidak ditemukan.</p>";
        }
} else {
    echo "<p>ID Kompetisi tidak ditemukan.</p>";
}
?>