CREATE DATABASE crud_mahasiswa;
USE crud_mahasiswa;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(9) NOT NULL,
    prodi VARCHAR(50) NOT NULL,
    angkatan INT NOT NULL,
    foto VARCHAR(255),
    status ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
);
