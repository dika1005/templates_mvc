<?php

class Data_model
{
    private $table = 'dataposyandu';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }



    private $dbh;
    private $stmt;

    public function getAllData()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
    public function getDataByNIK($NIK)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE NIK = :NIK');
        $this->db->bind('NIK', $NIK);
        return $this->db->single();
    }
}
