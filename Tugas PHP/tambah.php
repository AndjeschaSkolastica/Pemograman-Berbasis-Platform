<?php
session_start();
if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

if(isset($_POST["submit"])) {
    if(tambah($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            document.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data ToDo</title>
</head>
<body>
    <h1>Tambah Data ToDo</h1>
    <form action="" method="post">
        <label for="list">To Do List :</label><br>
        <input type="text" id="list" name="list" required><br><br>
        <button type="submit" name="submit">Tambah Data!</button>
    </form>
</body>
</html>
