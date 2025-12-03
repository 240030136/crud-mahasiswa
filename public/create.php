<?php
require_once "../config/database.php";
require_once "../classes/Mahasiswa.php";

// Koneksi DB
$database = new Database();
$db = $database->getConnection();

// Object mahasiswa
$mahasiswa = new Mahasiswa($db);

$message = "";

if(isset($_POST['submit'])) {
    
    $mahasiswa->nama = $_POST['nama'];
    $mahasiswa->nim = $_POST['nim'];
    $mahasiswa->prodi = $_POST['prodi'];
    $mahasiswa->angkatan = $_POST['angkatan'];
    $mahasiswa->status = $_POST['status'];

    // Upload File
    if($_FILES['foto']['name']) {
        $fileName = time() . "_" . basename($_FILES['foto']['name']);
        $targetFile = "../uploads/" . $fileName;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if(in_array($imageFileType, $allowed) && $_FILES['foto']['size'] <= 2000000) {
            move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile);
            $mahasiswa->foto = $fileName;
        } else {
            $message = "File harus JPG/PNG dan ukuran < 2MB";
        }
    }

    if($mahasiswa->create()) {
        header("Location: index.php");
        exit;
    } else {
        $message = "Gagal menambahkan data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
</head>
<body>

<h2>Tambah Mahasiswa</h2>
<a href="index.php">← Kembali</a>
<br><br>

<?php if($message) echo "<p style='color:red;'>$message</p>"; ?>

<form action="" method="post" enctype="multipart/form-data">
    Nama: <input type="text" name="nama" required><br><br>
    NIM: <input type="text" name="nim" required><br><br>

    Program Studi:
    <select name="prodi" required>
        <option value="Bisnis Digital">Bisnis Digital</option>
        <option value="Sistem Informasi">Sistem Informasi</option>
        <option value="Teknik Komputer">Teknologi Informasi</option>
        <option value="Teknik Komputer">Sistem Komputer</option>
    </select>
    <br><br>

    Angkatan: <input type="number" name="angkatan" min="2000" max="2030" required><br><br>

    Status:
    <select name="status" required>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select>
    <br><br>

    Foto: <input type="file" name="foto" required><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>

</body>
</html>
