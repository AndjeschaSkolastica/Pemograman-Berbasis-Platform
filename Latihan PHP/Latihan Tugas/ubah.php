<?php
require 'functions.php';

//ambil data di URL
$ID = $_GET ["ID"];


// query data mahasiswa berdasarkan data mahasiswa
$mhs = query("SELECT * FROM mahasiswa WHERE ID = $ID ") [0];



//cek apakah tombol submit sudah ditekan atau belum 
 if(isset($_POST["submit"])) {
 
  //cek apakah data berhasil diubah atau tidak
if(ubah($_POST)> 0 ){
    echo "
    <script>
    alert('data berhasil diubah');
    document.location.href = 'index.php' ;
    </script>
    "; 
} else {
    echo "
    <script>
    alert('data  gagal  diubah');
    document.location.href = 'index.php';
    </script>
    "; 
}
 }
?>

<!DOCTYPE html>
<html >
<head>
    <title>Edit Data Mahasiswa</title>
  
</head>
<body>
<h1>Edit data Mahasiswa</h1> 
<form action="" method="post">
    <input type="hidden" name="ID" value ="<?= $mhs ["ID"];?>">
    <ul>

        <li>
            <label for="Nama"> Nama :</label>
           <input type="text" name="Nama" id ="Nama"
           required value ="<?= $mhs ["Nama"];?>"> 
           
        </li>

        <li>
            <label for="NIM"> NIM :</label>
           <input type="text" name="NIM" id ="NIM" 
           required value ="<?= $mhs ["NIM"];?>">
           
        </li>
        <li>
            <label for="email"> Email :</label>
           <input type="text" name="Email" id ="Email"
           required value ="<?= $mhs ["Email"];?>"> 
           
        </li>
        <li>
            <label for= "Jurusan"> Jurusan :</label>
           <input type="text" name="Jurusan" id ="Jurusan"
           required value ="<?= $mhs ["Jurusan"];?>"> 
           
        </li>
        
        <li>
            <label for="gambar"> Gambar :</label>
           <input type="text" name="gambar" id ="gambar"
           required value ="<?= $mhs ["gambar"];?>"> 
           
        </li>
        <li>
            <button type ="submit" name= "submit">Ubah Data!</button>
        </li>
    </ul>
</form>
</body>
</html>