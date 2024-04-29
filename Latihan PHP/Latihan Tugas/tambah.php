<?php
session_start();
if(!isset($_SESSION["login"])){
  header("Location : login.php");
  exit;
}
require 'functions.php';
//cek apakah tombol submit sudah ditekan atau belum 
 if(isset($_POST["submit"])) {
   //ambil data dari tiap form
  
  //cek apakah data berhasil ditambahkan atau tidak
if(tambah($_POST)> 0 ){
    echo "
    <script>
    alert('data berhasil ditambahkan');
    document.location.href = 'index.php' ;
    </script>
    "; 
} else {
    echo "
    <script>
    alert('data  gagal berhasil ditambahkan');
    document.location.href = 'index.php';
    </script>
    "; 
}
 }
?>

<!DOCTYPE html>
<html >
<head>
    <title>Tambah Data Mahasiswa</title>
  
</head>
<body>
<h1>Tambah data Mahasiswa</h1> 
<form action="" method="post">
    <ul>
        <li>
            <label for="Nama"> Nama :</label>
           <input type="text" name="Nama" id ="Nama"
           required> 
           
        </li>

        <li>
            <label for="NIM"> NIM :</label>
           <input type="text" name="NIM" id ="NIM" 
           required> 
           
        </li>
        <li>
            <label for="email"> Email :</label>
           <input type="text" name="Email" id ="Email"
           required> 
           
        </li>
        <li>
            <label for= "Jurusan"> Jurusan :</label>
           <input type="text" name="Jurusan" id ="Jurusan"
           required> 
           
        </li>
        
        <li>
            <label for="gambar"> Gambar :</label>
           <input type="text" name="gambar" id ="gambar"
           required> 
           
        </li>
        <li>
            <button type ="submit" name= "submit">Tambah Data!</button>
        </li>
    </ul>
</form>
</body>
</html>