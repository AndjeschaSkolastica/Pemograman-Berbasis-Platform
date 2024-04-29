<?php
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$todo = query("SELECT * FROM todo");
?>

<!DOCTYPE html>
<html>
<head><title>Halaman Admin</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>To Do List</h1>
    <form action="tambah.php" method="post">
        <input type="text" name="list" id="list" required>
        <button type="submit" name="submit">Tambah</button>
    </form>
    <table border="1" cellpadding="10" cellspacing="0">
      
        <?php $i = 1; ?>
        <?php foreach($todo as $row) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td>
                    <?php if($row["status"] == 0) : ?>
                        <a href="selesai.php?id=<?= $row["id"]; ?>">Selesai</a> |
                    <?php else : ?>
                        <s><?= $row["list"]; ?></s> |
                    <?php endif; ?>
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin akan menghapus data?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
