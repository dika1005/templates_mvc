<?php

class User_model
{
    private  $table = 'Users';
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

    public function getUserByNIK($NIK)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE NIK = :NIK');
        $this->db->bind('NIK', $NIK);
        return $this->db->single();
    }

    public function tambahDataUser($data)
    {
        try {
            $query = "INSERT INTO Users (NIK, Nama, Umur, Alamat, Jk) 
                      VALUES (:NIK, :Nama, :Umur, :Alamat, :Jk)";

            $this->db->query($query);
            $this->db->bind('NIK', $data['NIK']);
            $this->db->bind('Nama', $data['nama']);
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
}
