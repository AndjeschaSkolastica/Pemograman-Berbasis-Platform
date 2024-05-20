<?php
require 'functions.php';
// Koneksi ke database

if(isset($_POST["register"])){
    if(registrasi ($_POST) > 0 ){
        echo "<script>
        alert('user baru berhasil ditambahkan !');
        </script>";
        // Redirect ke halaman login setelah registrasi berhasil
        header("Location: login.php");
        exit;

    } else {
       echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <!-- Tautan ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tautan ke Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Gaya kustom -->
    <style>
        body {
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
        
        .form-register {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }
        .form-register .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px 40px 10px 10px; /* Tambahkan padding untuk menyisipkan ikon mata */
            font-size: 16px;
        }
        .form-register input[type="text"],
        .form-register input[type="password"] {
            margin-bottom: 25px;
        }
        .form-register input[type="text"] {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-register input[type="password"] {
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
    <!-- Header dengan informasi Nama, NIM, dan foto -->
    <header>
        <h1>Yosepha Andjescha Skolastica</h1>
        <p>215314180</p>
        <img src="jeje.jpg" alt="Andjescha">
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="form-register" action="" method="post">
                    <h2 class="h3 mb-3 font-weight-normal">Halaman Registrasi</h2>
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
                    <div class="form-group">
                        <label for="password2">Konfirmasi Password:</label>
                        <div class="position-relative"> <!-- Tambahkan class position-relative untuk mengatur posisi ikon mata -->
                            <input type="password" class="form-control" name="password2" id="password2">
                            <!-- Tambahkan ikon untuk menampilkan atau menyembunyikan password -->
                            <span class="show-password">
                                <i class="fas fa-eye" id="showConfirmPassword"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk menampilkan atau menyembunyikan password -->
    <script>
        // Dapatkan elemen input password
        const passwordField = document.getElementById("password");
        const confirmPasswordField = document.getElementById("password2");
        // Dapatkan ikon mata
        const showPasswordIcon = document.getElementById("showPassword");
        const showConfirmPasswordIcon = document.getElementById("showConfirmPassword");

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

        showConfirmPasswordIcon.addEventListener("click", function() {
            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
                showConfirmPasswordIcon.classList.remove("fa-eye");
                showConfirmPasswordIcon.classList.add("fa-eye-slash");
            } else {
                confirmPasswordField.type = "password";
                showConfirmPasswordIcon.classList.remove("fa-eye-slash");
                showConfirmPasswordIcon.classList.add("fa-eye");
            }
        });
    </script>
</body>
</html>
