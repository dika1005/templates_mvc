<?php

class Data_model
{
    private $table = 'data';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }



    private $dbh;
    private $stmt;

    public function getAllData()
    {
       $this ->db->query('SELECT * FROM ' . $this->table);
       return $this->db->resultSet();
    }
}
