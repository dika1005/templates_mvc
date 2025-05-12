<?php

class Data_model
{
    private  $table = 'dataposyandu';
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
    public function getAllDataPosyandu()
    {
        $this->db->query("SELECT * FROM dataposyandu");
        return $this->db->resultSet();
    }
    
}
