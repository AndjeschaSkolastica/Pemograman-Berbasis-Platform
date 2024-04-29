<?php
session_start();

if( !isset($_SESSION["login"])){
    header("Location : login.php");
    exit;
  }
 require 'functions.php';
$mahasiswa = query("SELECT*FROM mahasiswa");

?>


<!DOCTYPE html>
<html>
<head>
<title>Halaman Admin</title>
</head>
<body>
    <a href="logout.php">Logout</a>
<h1>Daftar Mahasiswa</h1>
<a href="tambah.php">Tambah data Mahasiswa</a>
<table border ="1" cellpadding = "10" cellspacing ="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>

    </tr>
    <?php $i = 1; ?>
    <?php foreach( $mahasiswa as $row) : ?>
    <tr>
        <td><?=$i; ?></td>
        <td>
            <a href= "ubah.php?ID= <?=  $row["ID"]; ?> " >ubah </a> |
            <a href="hapus.php?ID= <?=  $row["ID"]; ?>" onclick="return confirm ('yakin akan menghapus data?'); " > hapus</a>
        </td>
        <td><img src="img/<?=  $row["gambar"]; ?>" width ="50" ></td>
        <td><?=$row["NIM"];?></td>
        <td><?=$row["Nama"];?></td>
        <td><?=$row["Email"];?></td>
        <td><?=$row["Jurusan"];?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>


</body>
</html>