<?php

class Dokumentasi_model
{
    private  $table = 'dokumentasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllDokumentasi()
    {
        $this->db->query("SELECT id, src, caption FROM " . $this->table . " ORDER BY id DESC");
        return $this->db->resultSet();
    }
}
