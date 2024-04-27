<?php 
// koneksi kedatabase
$conn = mysqli_connect("localhost","root","","phpdasar");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data){
  global $conn;

  $Nama = htmlspecialchars($data["Nama"]);
  $NIM = htmlspecialchars($data["NIM"]);
  $Email= htmlspecialchars($data["Email"]);
  $Jurusan = htmlspecialchars($data["Jurusan"]);
  $gambar = htmlspecialchars($data["gambar"]);
    // query insert data
    $query = "INSERT INTO mahasiswa
    VALUES
    ('', '$Nama', '$NIM','$Email','$Jurusan','$gambar')
    ";
mysqli_query($conn, $query);
return mysqli_affected_rows($conn);
}


function hapus ($ID) {
    global $conn;
    mysqli_query($conn,"DELETE FROM mahasiswa WHERE ID = $ID" );
    return mysqli_affected_rows($conn);


}


?> 