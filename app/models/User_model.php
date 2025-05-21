<?php

class User_model
{
    private $table = 'Users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // method untuk mendapatkan semua data admin
    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    // method untuk mendapatkan data admin berdasarkan NIK
    public function findByIdentifier($identifier)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE NIK = :identifier');
        $this->db->bind('identifier', $identifier);
        return $this->db->single();
    }

    // method untuk mendapatkan data admin berdasarkan NIK
    public function tambahDataUser($data)
    {
        try {
            if (!isset($data['password'], $data['NIK'], $data['nama'], $data['umur'], $data['alamat'], $data['gender'])) {
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
            return $this->db->rowCount();
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

    // method untuk mendapatkan data admin berdasarkan NIK
    public function updateDataUser($data)
    {
        if (!isset($data['NIK'], $data['nama'], $data['gender'])) {
            return 0;
        }

        try {
            $query = "UPDATE " . $this->table . " SET
                      Nama = :Nama,
                      Umur = :Umur,
                      Alamat = :Alamat,
                      Jk = :Jk";

            if (isset($data['password']) && !empty($data['password'])) {
                $query .= ", Password = :Password";
            }

            $query .= " WHERE NIK = :NIK";

            $this->db->query($query);
            $this->db->bind('NIK', $data['NIK']);
            $this->db->bind('Nama', $data['nama']);
            $this->db->bind('Umur', $data['umur']);
            $this->db->bind('Alamat', $data['alamat']);
            $this->db->bind('Jk', $data['gender']);

            if (isset($data['password']) && !empty($data['password'])) {
                $this->db->bind('Password', password_hash($data['password'], PASSWORD_DEFAULT));
            }

            $this->db->execute();
            return $this->db->rowCount();
        } catch (Exception $e) {
            return 0;
        }
    }
}
