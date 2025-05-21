<?php

class Admin_model
{
    private  $table = 'Admin';
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
        $user = $this->db->single();
        return $user;
    }

    // method untuk menambahkan data admin
    public function getAllDataPosyandu()
    {
        $this->db->query("SELECT * FROM dataposyandu");
        return $this->db->resultSet();
    }
}
