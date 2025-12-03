<?php
require_once "../config/database.php";
require_once "../classes/Mahasiswa.php";

// Koneksi DB
$database = new Database();
$db = $database->getConnection();

// Buat object mahasiswa
$mahasiswa = new Mahasiswa($db);

// Ambil semua data
$list = $mahasiswa->readAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
</head>
<body>

<h2>Daftar Mahasiswa</h2>
<a href="create.php">+ Tambah Mahasiswa</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Prodi</th>
        <th>Angkatan</th>
        <th>Foto</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = $list->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nim']; ?></td>
            <td><?= $row['prodi']; ?></td>
            <td><?= $row['angkatan']; ?></td>
            <td>
                <?php if($row['foto']) { ?>
                    <img src="../uploads/<?= $row['foto']; ?>" width="50">
                <?php } else { echo "-"; } ?>
            </td>
            <td><?= $row['status']; ?></td>
            <td>
                <a href="update.php?id=<?= $row['id']; ?>">Edit</a> | 
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus data ini?');">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
