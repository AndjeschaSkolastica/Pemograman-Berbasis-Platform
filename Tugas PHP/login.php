<?php
session_start();

//cek cookie
if (isset($_COOKIE['id'])&& isset($_COOKIE['key'])){
    $id= $_COOKIE['id'];
    $key= $_COOKIE['key'];

    //mengambil username berdasarkan id
    $result= mysqli_query($con,"SELECT username FROM users WHERE id =$id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login']= true;
        
    }
} 

if (isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}

require 'functions.php';

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($result) === 1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            //cek session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST["remember"])){
                //buat cookie
                setcookie('id', $row['id'], time()+60);
                setcookie('key',hash('sha256', $row['username']), time()+ 60);
            }
            $id = $row["id"];
            header("Location: index.php?ID=$id");
            exit;
        }
    }
    $error = true;

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <!-- Tautan ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tautan ke Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Gaya kustom -->
    <style>
        body {
            /* Membuat latar belakang gambar */
            background-image:url('2.gif');
            background-size: cover;
            /*Warna teks agar terlihat jelas di atas latar belakang */
            color:#000000; 
            /* Mengatur tinggi viewport agar konten muncul di tengah */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Menata konten secara vertikal */
        }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px 40px 10px 10px; /* Tambahkan padding untuk menyisipkan ikon mata */
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="text"] {
            margin-bottom: 25px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 25px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        /* CSS untuk tombol mata */
        .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ccc;
            z-index: 99; /* Pastikan ikon tetap di atas bidang input */
        }
        /* CSS untuk header */
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            margin-bottom: 10px;
        }
        header p {
            margin-bottom: 5px;
        }
        header img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Header dengan informasi Nama, Nim, dan Foto -->
    <header>
        <h1>Yosepha Andjescha Skolastica</h1>
        <p>215314180</p>
        <img src="jeje.jpg" alt="Andjescha" >
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="form-signin" action="" method="post">
                    <h2 class="h3 mb-3 font-weight-normal">Halaman Login</h2>
                    <?php if (isset($error)): ?>
                        <p style="color: red; font-style: italic;">Username atau password salah</p>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <div class="position-relative"> <!-- Tambahkan class position-relative untuk mengatur posisi ikon mata -->
                            <input type="password" class="form-control" name="password" id="password">
                            <!-- Tambahkan ikon untuk menampilkan atau menyembunyikan password -->
                            <span class="show-password">
                                <i class="fas fa-eye" id="showPassword"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <p class="mt-3">Belum punya akun? <a href="registrasi.php">Daftar sekarang</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk menampilkan atau menyembunyikan password -->
    <script>
        // Dapatkan elemen input password
        const passwordField = document.getElementById("password");
        // Dapatkan ikon mata
        const showPasswordIcon = document.getElementById("showPassword");

        // Tambahkan event listener untuk mengubah tipe input password menjadi text dan sebaliknya saat ikon mata diklik
        showPasswordIcon.addEventListener("click", function() {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                showPasswordIcon.classList.remove("fa-eye");
                showPasswordIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                showPasswordIcon.classList.remove("fa-eye-slash");
                showPasswordIcon.classList.add("fa-eye");
            }
        });
    </script>
</body>
</html>




