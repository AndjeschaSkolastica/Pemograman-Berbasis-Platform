<?php
// koneksi kedatabase
$conn = mysqli_connect("localhost","root","","phpdasar");


// ambil data dari tabel mahasiswa
$result = mysqli_query($conn, "SELECT*FROM mahasiswa");

// ambil data (fetch) mahasiswa dari object result
//mysqli_fetch_row() // menegembalikan array numerik
//mysqli_fetch_assoc() // mengembalikan array asossiatif
//mysqli_fetch_array() // mengambalikan numerik dan asossiatif
//mysqli_fetch_object() // menegembalikan object

 //while( $mhs = mysqli_fetch_assoc($result) ) {
   // var_dump($mhs);
 //}
?>


<!DOCTYPE html>
<html>
<head>
<title>Halaman Admin</title>
</head>
<body>
<h1>Daftar Mahasiswa</h1>
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
    <?php while ($row = mysqli_fetch_assoc ($result)) : ?>
    <tr>
        <td><?=$i; ?></td>
        <td>
            <a href="">ubah</a> |
            <a href="">hapus</a>
        </td>
        <td><img src="img/<?=  $row["gambar"]; ?>" width ="50" ></td>
        <td><?=$row["NIM"];?></td>
        <td><?=$row["Nama"];?></td>
        <td><?=$row["Email"];?></td>
        <td><?=$row["Jurusan"];?></td>
    </tr>
    <?php $i++; ?>
    <?php endwhile; ?>
</table>


</body>
</html>