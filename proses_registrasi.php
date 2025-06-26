<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['konfirmasi_password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi_password'];

    if($password !== $konfirmasi){
        echo "<script>alert('Password dan konfirmasi password tidak cocok!');window.location='registrasi.php';</script>";
        exit;
    }

    // Cek username sudah ada atau belum
    $cek_user = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE username='$username'");
    if(mysqli_num_rows($cek_user) > 0){
        echo "<script>alert('Username sudah digunakan!');window.location='registrasi.php';</script>";
        exit;
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert data baru, dengan jabatan default 'Karyawan'
    $sql = "INSERT INTO tb_karyawan (username, password, nama, tmp_tgl_lahir, jenkel, agama, alamat, no_tel, jabatan, foto) 
            VALUES ('$username', '$password_hash', '', '', '', '', '', '', 'Karyawan', '')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Registrasi berhasil! Silahkan login.');window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Form registrasi tidak lengkap.');window.location='registrasi.php';</script>";
}
?>
