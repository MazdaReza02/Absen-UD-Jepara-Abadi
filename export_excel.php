<?php
include 'koneksi.php';

// Set header agar langsung mendownload
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=Data_Absen.csv");
header("Pragma: no-cache");
header("Expires: 0");

// Buka output
$output = fopen("php://output", "w");

// Header kolom
fputcsv($output, ['No', 'ID Karyawan', 'Nama', 'Keterangan', 'Alasan', 'Waktu', 'Bukti']);

// Ambil data dari tb_absen
$sql1 = mysqli_query($koneksi, "SELECT id_karyawan, nama, 'Hadir' AS keterangan, '' AS alasan, waktu, '' AS bukti FROM tb_absen");

// Ambil data dari tb_keterangan
$sql2 = mysqli_query($koneksi, "SELECT id_karyawan, nama, keterangan, alasan, waktu, bukti FROM tb_keterangan");

// Gabungkan & tulis ke CSV
$no = 1;
while ($row = mysqli_fetch_assoc($sql1)) {
    fputcsv($output, [$no++, $row['id_karyawan'], $row['nama'], $row['keterangan'], $row['alasan'], $row['waktu'], $row['bukti']]);
}
while ($row = mysqli_fetch_assoc($sql2)) {
    fputcsv($output, [$no++, $row['id_karyawan'], $row['nama'], $row['keterangan'], $row['alasan'], $row['waktu'], $row['bukti']]);
}

fclose($output);
exit;
?>
