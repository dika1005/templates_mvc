<?php

class Dokumentasi_model
{
    private $table = 'dokumentasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // method untuk mendapatkan semua data dokumentasi
    public function getAllDokumentasi()
    {
        $query = "SELECT * FROM dokumentasi";
        $this->db->query($query); 
        return $this->db->resultSet(); 
    }

    // method untuk mendapatkan data dokumentasi berdasarkan id
    public function getGambarById($id)
    {
        $this->db->query("SELECT gambar, tipe_gambar FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // method untuk mendapatkan data dokumentasi berdasarkan id
    public function simpan($data)
    {
        $query = "INSERT INTO dokumentasi (judul, gambar, tipe_gambar) VALUES (:judul, :gambar, :tipe_gambar)";
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('gambar', $data['gambar'], PDO::PARAM_LOB);
        $this->db->bind('tipe_gambar', $data['tipe_gambar']);
        return $this->db->execute();
    }

    // method untuk menghapus data dokumentasi berdasarkan id
    public function deleteGambar($id)
    {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
