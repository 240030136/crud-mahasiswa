<?php

class Mahasiswa {
    private $conn;
    private $table = "mahasiswa";

    public $id;
    public $nama;
    public $nim;
    public $prodi;
    public $angkatan;
    public $foto;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table . "
                  SET nama=:nama, nim=:nim, prodi=:prodi, angkatan=:angkatan, foto=:foto, status=:status";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":prodi", $this->prodi);
        $stmt->bindParam(":angkatan", $this->angkatan);
        $stmt->bindParam(":foto", $this->foto);
        $stmt->bindParam(":status", $this->status);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ ALL
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data) {
            $this->nama = $data['nama'];
            $this->nim = $data['nim'];
            $this->prodi = $data['prodi'];
            $this->angkatan = $data['angkatan'];
            $this->foto = $data['foto'];
            $this->status = $data['status'];
        }
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table . "
                  SET nama=:nama, nim=:nim, prodi=:prodi, angkatan=:angkatan, foto=:foto, status=:status
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":prodi", $this->prodi);
        $stmt->bindParam(":angkatan", $this->angkatan);
        $stmt->bindParam(":foto", $this->foto);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
