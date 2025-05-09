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
        $query = "INSERT INTO Users (NIK, Nama, Umur, Tb, Bb, Alamat, Jk)
              VALUES (:NIK, :Nama, :Umur, :Tb, :Bb, :Alamat, :Jk)";

        $this->db->query($query);
        $this->db->bind('NIK', $data['NIK']);
        $this->db->bind('Nama', $data['nama']);
        $this->db->bind('Umur', $data['umur']);
        $this->db->bind('Tb', $data['tinggi']);
        $this->db->bind('Bb', $data['berat']);
        $this->db->bind('Alamat', $data['alamat']);
        $this->db->bind('Jk', $data['gender']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
