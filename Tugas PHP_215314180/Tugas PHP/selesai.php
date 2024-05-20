<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

// Ubah status to-do menjadi selesai (status = 1)
if (ubahStatus($id, 'selesai') > 0) {
    header("Location: index.php");
    exit;
} else {
    echo "<script>
            alert('Gagal mengubah status');
            window.history.back();
          </script>";
}
?>
