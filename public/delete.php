<?php
require_once "../config/database.php";
require_once "../classes/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$mahasiswa->id = $_GET['id'];

$mahasiswa->readOne();
$fotoLama = $mahasiswa->foto;

if ($mahasiswa->delete()) {


    if ($fotoLama && file_exists("../uploads/" . $fotoLama)) {
        unlink("../uploads/" . $fotoLama);
    }

    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data!";
}
