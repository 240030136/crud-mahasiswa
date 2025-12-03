<?php
require_once "../config/database.php";
require_once "../classes/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

// Pastikan ID ada
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$mahasiswa->id = $_GET['id'];

// Ambil data dulu untuk ambil nama file foto (opsional)
$mahasiswa->readOne();
$fotoLama = $mahasiswa->foto;

// Hapus dari database
if ($mahasiswa->delete()) {

    // Hapus file foto (opsional)
    if ($fotoLama && file_exists("../uploads/" . $fotoLama)) {
        unlink("../uploads/" . $fotoLama);
    }

    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data!";
}
