<?php
session_start();
if (!isset($_SESSION['usersi'])) {
    header("Location: login_karyawan.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Karyawan</title>
  <link rel="icon" href="assets/img/Logo-DEVanoda.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
  <style>
    .btn-absen {
      display: inline-block;
      padding: 12px 20px;
      margin: 10px;
      font-size: 16px;
      border: none;
      background-color: #00BFFF;
      color: white;
      cursor: pointer;
      border-radius: 8px;
      text-decoration: none;
    }
    .btn-absen:hover {
      background-color: #009ACD;
    }
  </style>
</head>
<body>
  <div class="main-w3layouts wrapper">
    <center><img src="assets/img/Logo-DEVanoda.png" width="250" height="90"></center>
    <h1>Selamat Datang, <?php echo $_SESSION['namasi']; ?></h1>
    <div class="main-agileinfo">
      <div class="agileits-top" style="text-align: center;">
        <p>Silakan pilih jenis absensi Anda:</p>
        <a href="proses_absen.php?tipe=masuk" class="btn-absen">Absensi Masuk</a>
        <a href="proses_absen.php?tipe=pulang" class="btn-absen">Absensi Pulang</a>
        <a href="form_izin.php" class="btn-absen">Izin</a>
      </div>
    </div>
    <div class="colorlibcopy-agile">
      <p>© 2025 UD Jepara Abadi. All rights reserved.</p>
    </div>
    <ul class="colorlib-bubbles">
      <li></li><li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li><li></li>
    </ul>
  </div>
</body>
</html>
