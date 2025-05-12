<?php

class User_model
{
    private $table = 'Users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function findByIdentifier($identifier)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE NIK = :identifier');
        $this->db->bind('identifier', $identifier);
        $user = $this->db->single();
        return $user;
    }

    public function tambahDataUser($data)
    {
        try {
            if (!isset($data['password'])) {
                return 0;
            }

            $plainPassword = $data['password'];
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            if ($hashedPassword === false) {
                return 0;
            }

            $query = "INSERT INTO Users (NIK, Nama, Password, Umur, Alamat, Jk)
                      VALUES (:NIK, :Nama, :Password, :Umur, :Alamat, :Jk)";

            $this->db->query($query);
            $this->db->bind('NIK', $data['NIK']);
            $this->db->bind('Nama', $data['nama']);
            $this->db->bind('Password', $hashedPassword);
            $this->db->bind('Umur', $data['umur']);
            $this->db->bind('Alamat', $data['alamat']);
            $this->db->bind('Jk', $data['gender']);

            $this->db->execute();

            return 1;
        } catch (PDOException $e) {
            if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
                return 'duplikat';
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateDataUser($data)
    {
        // Validasi data input minimal
        if (!isset($data['NIK'], $data['nama'], $data['umur'], $data['alamat'], $data['gender'])) {
            // Data input tidak lengkap
            return 0; // Atau nilai error lain
        }

        try {
            $query = "UPDATE " . $this->table . " SET
                      Nama = :Nama,
                      Umur = :Umur,
                      Alamat = :Alamat,
                      Jk = :Jk";

            // Periksa apakah password baru diisi
            if (!empty($data['password'])) {
                $query .= ", Password = :Password";
            }

            $query .= " WHERE NIK = :NIK";

            $this->db->query($query);

            // *** DEBUGGING: Lihat query yang akan dijalankan ***
            // var_dump($query);

            // Binding parameter
            $this->db->bind('NIK', $data['NIK']); // Pastikan NIK dari POST ada dan benar
            $this->db->bind('Nama', $data['nama']);
            $this->db->bind('Umur', $data['umur']);
            $this->db->bind('Alamat', $data['alamat']);
            $this->db->bind('Jk', $data['gender']);

            // Binding password jika diisi
            if (!empty($data['password'])) {
                $this->db->bind('Password', password_hash($data['password'], PASSWORD_DEFAULT));
            }

            $this->db->execute();

            // *** DEBUGGING: Lihat jumlah baris yang terpengaruh oleh query ***
            // var_dump($this->db->rowCount());

            // rowCount akan mengembalikan jumlah baris yang diubah.
            // Jika data yang disubmit SAMA PERSIS dengan data di database (kecuali password jika tidak diubah),
            // rowCount bisa saja 0 meskipun query berhasil dieksekusi.
            // Namun, jika NIK tidak ditemukan, rowCount juga akan 0.
            // Jadi, jika rowCount 0, ada 2 kemungkinan: NIK tidak ada ATAU data tidak berubah.
            return $this->db->rowCount();

        } catch (Exception $e) {
            // *** DEBUGGING: Lihat error yang terjadi saat eksekusi query ***
            // var_dump($e->getMessage());
            return 0; // Mengembalikan 0 jika terjadi error
        }
    }


}
