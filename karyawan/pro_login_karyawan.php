<?php 
include_once "../koneksi.php";

$username = $_POST['username'];
$pass = md5($_POST['password']);

$sql = "SELECT * FROM tb_karyawan WHERE username='$username' AND password='$pass'";
$login = mysqli_query($koneksi, $sql);
$ketemu = mysqli_num_rows($login);

if ($ketemu > 0) {
    $b = mysqli_fetch_array($login);
    session_start();
    $_SESSION['idsi']       = $b['id_karyawan'];
    $_SESSION['usersi']     = $b['username'];
    $_SESSION['namasi']     = $b['nama'];
    $_SESSION['ttlsi']      = $b['tmp_tgl_lahir'];
    $_SESSION['jenkelsi']   = $b['jenkel'];
    $_SESSION['agamasi']    = $b['agama'];
    $_SESSION['alamatsi']   = $b['alamat'];
    $_SESSION['teleponsi']  = $b['no_tel'];
    $_SESSION['jabatansi']  = $b['jabatan'];
    $_SESSION['fotosi']     = $b['foto'];

    // Redirect ke dashboard
    header("Location: index.php?m=awal");
    exit();
} else {
    // Jangan kirim output sebelum header!
    header("Location: login_karyawan.php?pesan=gagal");
    exit();
}
?>
