<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta'); // Gunakan waktu Indonesia

if (isset($_POST['simpan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    
    $waktu = date('Y-m-d H:i:s'); // Ambil waktu sekarang otomatis
    $tanggal = date('Y-m-d');     // Ambil tanggal saja untuk validasi

    // Cek apakah sudah absen hari ini
    $cek = mysqli_query($koneksi, "SELECT * FROM tb_absen 
                                   WHERE id_karyawan = '$id_karyawan' 
                                   AND DATE(waktu) = '$tanggal'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Anda sudah absen untuk hari ini!');</script>";
        echo "<script>window.location.href = 'index.php?m=awal';</script>";
        exit;
    }

    // Simpan absensi jika belum absen
    $save = mysqli_query($koneksi, "INSERT INTO tb_absen 
                                    SET id_karyawan='$id_karyawan', 
                                        nama='$nama', 
                                        waktu='$waktu'");

    if ($save) {
        echo "<script>alert(' Absensi berhasil pada $waktu');</script>";
        echo "<script>window.location.href = 'index.php?m=awal';</script>";    
    } else {
        echo "<script>alert('Gagal menyimpan absensi!');</script>";
    }
}
?>
