<?php
$mahasiswa =["Andjescha","215314180", "Teknik Informatika","skolasticayosph@gmail.com"];

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Daftar Mahasiswa</title>
  </head>
  <body>
    
    <h1>Daftar Mahasiswa</h1>

    <ul>
      <? php foreach($mahasiswa as $mhs) :?>
      <li><?= $mhs; ?></li>
    </ul>
  </body>
</html>
