<?php
session_start();

if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

$id = isset($_GET["ID"]) ? $_GET["ID"] : null;

require 'functions.php';

$username = '';

// Mengambil nama pengguna dari database berdasarkan ID
if ($id !== null) {
    $query = "SELECT username FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
    }
}

// Proses tambah tugas
if (isset($_POST['tambah'])) {
    $list = $_POST['list'];
    tambah($list, $id);
    header("Location: index.php?ID=$id"); // Perbarui URL
    exit;
}

// Proses tanda selesai tugas
if (isset($_GET['selesai'])) {
    $selesai_id = $_GET['selesai'];
    selesai($selesai_id);
    header("Location: index.php?ID=$id"); // Perbarui URL
    exit;
}

// Proses hapus tugas
if (isset($_GET['hapus'])) {
    $hapus_id = $_GET['hapus'];
    hapus($hapus_id);
    header("Location: index.php?ID=$id"); // Perbarui URL
    exit;
}

// Ambil semua tugas
$todo = mysqli_query($conn, "SELECT * FROM todo");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">ToDo List - <?php echo $username; ?></h1>
    <form action="" method="post">
        <div class="input-group mb-3">
        <input type="text" class="form-control" style="max-width: 300px;" placeholder="Tambah tugas" name="list" maxlength="100" required>
        <button class="btn btn-primary" type="submit" name="tambah">Tambah</button> 
        </div>
    </form>

    <ul class="list-group">
        <?php while ($row = mysqli_fetch_assoc($todo)) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php if ($row['status'] == "aktif") { ?>
                    <?php echo $row['list']; ?>
                <?php } else { ?>
                    <del><?php echo $row['list']; ?></del>
                <?php } ?>
                <div>
                    <a href="?selesai=<?php echo $row['id']; ?>&ID=<?php echo $id; ?>" class="btn btn-success me-2">Selesai</a>
                    <a href="?hapus=<?php echo $row['id']; ?>&ID=<?php echo $id; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 