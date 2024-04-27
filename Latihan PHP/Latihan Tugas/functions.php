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

function ubah ($data){
    global $conn;
    
    $ID = $data["ID"];
    $Nama = htmlspecialchars($data["Nama"]);
    $NIM = htmlspecialchars($data["NIM"]);
    $Email= htmlspecialchars($data["Email"]);
    $Jurusan = htmlspecialchars($data["Jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

      // query insert data
      $query = "UPDATE  mahasiswa SET
      Nama = '$Nama',
      NIM = '$NIM',
      Email = '$Email',
      Jurusan = '$Jurusan',
      gambar = '$gambar'
    WHERE ID = $ID
      ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function registrasi ($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  //cek username sudah ada atau belum 
  $result= mysqli_query($conn,"SELECT username FROM users WHERE username ='$username'");

  
      if (mysqli_fetch_row($result)) {
         echo "<script>
               alert('username sudah terdaftar');
               </script>";
         return false;
} 


  //cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>
    alert ('konfirmasi password tidak sesuai');
    </script>";
  return false;
  }
  
// enskripsi password
$password = password_hash($password, PASSWORD_DEFAULT);


// tambahkan userbaru ke database
mysqli_query($conn, "INSERT INTO users VALUES ('','$username','$password')");
return mysqli_affected_rows($conn);

}

?> 