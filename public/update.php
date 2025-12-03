<?php
require_once "../config/database.php";
require_once "../classes/Mahasiswa.php";

// Koneksi
$database = new Database();
$db = $database->getConnection();

// Object Mahasiswa
$mahasiswa = new Mahasiswa($db);

// Cek id
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$mahasiswa->id = $_GET['id'];
$mahasiswa->readOne(); // Ambil data lama

$message = "";

// Update jika submit ditekan
if (isset($_POST['submit'])) {
    $mahasiswa->nama = $_POST['nama'];
    $mahasiswa->nim = $_POST['nim'];
    $mahasiswa->prodi = $_POST['prodi'];
    $mahasiswa->angkatan = $_POST['angkatan'];
    $mahasiswa->status = $_POST['status'];

    // Jika update gambar baru
    if ($_FILES['foto']['name']) {
        $fileName = time() . "_" . basename($_FILES['foto']['name']);
        $targetFile = "../uploads/" . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ["jpg", "jpeg", "png"]) && $_FILES['foto']['size'] <= 2000000) {
            move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile);
            $mahasiswa->foto = $fileName;
        } else {
            $message = "Foto harus JPG/PNG dan ukuran < 2MB";
        }
    }

    if ($mahasiswa->update()) {
        header("Location: index.php");
        exit;
    } else {
        $message = "Gagal mengupdate data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
</head>
<body>

<h2>Edit Mahasiswa</h2>
<a href="index.php">← Kembali</a>
<br><br>

<?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>

<form action="" method="post" enctype="multipart/form-data">
    Nama: <input type="text" name="nama" value="<?= $mahasiswa->nama ?>" required><br><br>
    NIM: <input type="text" name="nim" value="<?= $mahasiswa->nim ?>" required><br><br>

    Program Studi:
    <select name="prodi" required>
        <option value="Bisnis Digital" <?= ($mahasiswa->prodi == 'Bisnis Digital') ? 'selected' : '' ?>>Bisnis Digital  </option>
        <option value="Sistem Informasi" <?= ($mahasiswa->prodi == 'Sistem Informasi') ? 'selected' : '' ?>>Sistem Informasi</option>
        <option value="Teknik Komputer" <?= ($mahasiswa->prodi == 'Teknik Komputer') ? 'selected' : '' ?>>Teknik Komputer</option>
    </select>
    <br><br>

    Angkatan: <input type="number" name="angkatan" value="<?= $mahasiswa->angkatan ?>" required><br><br>

    Status:
    <select name="status" required>
        <option value="aktif" <?= ($mahasiswa->status == 'aktif') ? 'selected' : '' ?>>Aktif</option>
        <option value="nonaktif" <?= ($mahasiswa->status == 'nonaktif') ? 'selected' : '' ?>>Nonaktif</option>
    </select>
    <br><br>

    Foto saat ini:<br>
    <?php if ($mahasiswa->foto) { ?>
        <img src="../uploads/<?= $mahasiswa->foto ?>" width="80"><br><br>
    <?php } ?>
    Ganti Foto (opsional): <input type="file" name="foto"><br><br>

    <button type="submit" name="submit">Update</button>
</form>

</body>
</html>
