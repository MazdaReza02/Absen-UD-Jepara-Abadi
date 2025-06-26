<?php 
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['simpan'])) {
    $id_karyawan = mysqli_real_escape_string($koneksi, $_POST['id_karyawan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $alasan = mysqli_real_escape_string($koneksi, $_POST['alasan']);
    $waktu = date('Y-m-d H:i:s');
    $tanggal_hari_ini = date('Y-m-d');

    if (empty($id_karyawan) || empty($nama) || empty($keterangan) || empty($alasan)) {
        echo "<script>alert('Semua field wajib diisi'); window.history.back();</script>";
        exit;
    }

    $cek = mysqli_query($koneksi, 
        "SELECT COUNT(*) AS total FROM tb_keterangan 
         WHERE id_karyawan='$id_karyawan' AND DATE(waktu)='$tanggal_hari_ini'");
    $data = mysqli_fetch_assoc($cek);
    if ($data['total'] > 0) {
        echo "<script>alert('Anda sudah absen hari ini'); window.history.back();</script>";
        exit;
    }

    if ($_FILES['bukti']['error'] === 0) {
        $bukti = $_FILES['bukti']['name'];
        $tmp = $_FILES['bukti']['tmp_name'];
        $buktibaru = date('dmYHis') . '_' . $bukti;
        $path = "images/" . $buktibaru;
        $ext = strtolower(pathinfo($bukti, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed) || $_FILES['bukti']['size'] > 2 * 1024 * 1024) {
            echo "<script>alert('Bukti harus gambar dan max 2MB'); window.history.back();</script>";
            exit;
        }

        if (!move_uploaded_file($tmp, $path)) {
            echo "<script>alert('Upload gagal'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Bukti wajib diupload'); window.history.back();</script>";
        exit;
    }

    $query = "INSERT INTO tb_keterangan (id_karyawan, nama, keterangan, alasan, waktu, bukti) 
              VALUES ('$id_karyawan', '$nama', '$keterangan', '$alasan', '$waktu', '$buktibaru')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Berhasil absen'); window.history.back();</script>";
    } else {
        echo "<script>alert('Gagal simpan data'); window.history.back();</script>";
    }
}
?>
