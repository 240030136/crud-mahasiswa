# Aplikasi CRUD Mahasiswa – PHP Native + PDO

## Deskripsi Aplikasi
Aplikasi ini merupakan sistem backend sederhana untuk mengelola data mahasiswa menggunakan operasi CRUD (Create, Read, Update, Delete). Data akan disimpan pada database MySQL dan berisikan:

- Field teks: nama, NIM
- Field angka: angkatan
- Field pilihan (select): prodi, status
- Upload file: foto mahasiswa

## Spesifikasi Teknis
- Bahasa: PHP 8.x (native)
- Database: MySQL / MariaDB
- Driver Database: PDO
- Server lokal: `php -S localhost:8000 -t public`

### Struktur Folder
- classes/
  Mahasiswa.php<br>
- config/<br>
  database.php<br>
- public/<br>
  index.php<br>
  create.php<br>
  update.php<br>
  delete.php<br>
- upload/<br>
  schema.sql<br>
- README.md<br>


### Class Utama
- `Mahasiswa.php`: berisi fitur CRUD
- `Database.php`: koneksi database dengan PDO

---

## Cara Menjalankan Aplikasi

1. Import database:
   - Buka phpMyAdmin
   - Buat database `crud_mahasiswa`
   - Import file `schema.sql`

2. Jalankan server:
   ```sh
   php -S localhost:8000 -t public


