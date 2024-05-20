<?php 
$host = "localhost";
$user = "root";
$pass = "";
$database = "tugas_php";

//koneksi ke dtabase
$conn = mysqli_connect($host, $user, $pass, $database);

function query($query) {
    global $conn;
    $result = mysqli_query($conn , $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

}
return $rows;
}

function tambah($list, $id) {
    global $conn;
    $list= mysqli_real_escape_string($conn, $list);
    $query = "INSERT INTO todo (list, user_id) VALUES ('$list', '$id')";
    if (mysqli_query($conn , $query)) {
        return mysqli_affected_rows($conn);
    } else {
        // Tangani error
        echo "Error: " . mysqli_error($conn);
        return false;
    }

// Tambahkan todo                                 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['list'])) {
    // Memeriksa apakah form telah diisi
    if (empty($_POST['list'])) {
        echo "<script>alert('Form harus diisi terlebih dahulu.');</script>";
    } else {
        $list = $_POST["list"];
        $status = "";

        // Memeriksa apakah todo yang sama sudah ada
        $check_sql = "SELECT * FROM todo WHERE list = '$list'";
        $result = $conn->query($check_sql);

        if ($result->num_rows > 0) {
            // Menjalankan query untuk menambahkan todo baru jika semua syarat terpenuhi
            $sql = "INSERT INTO todo (list, status) VALUES ('$list', '$status')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Todo berhasil ditambahkan.');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }}
    }
}




function hapus($id) {
    global $conn;
    mysqli_query($conn,"DELETE FROM todo WHERE id = $id");
    return mysqli_affected_rows($conn);

    
}

// Fungsi untuk mengubah status item to-do menjadi 'selesai'
function selesai($id) {
    global $conn;
    $query = "UPDATE todo SET status = 'Selesai' WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);


}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    
    // Periksa koneksi sebelum menjalankan query
    if (!mysqli_ping($conn)) {
        echo "<script>alert('Koneksi ke server MySQL terputus');</script>";
        return false;
    }

    // Query untuk memeriksa keberadaan username
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (!$result) {
        echo "<script>alert('Query tidak dapat dieksekusi');</script>";
        return false;
    }

    // Periksa apakah username sudah terdaftar
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username sudah terdaftar');</script>";
        return false;
    }

    // Periksa kesesuaian password
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    $query = "INSERT INTO users VALUES('', '$username', '$password')";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        return mysqli_affected_rows($conn);
    } else {
        echo "<script>alert('Registrasi gagal');</script>";
        return false;
    }
}


?>