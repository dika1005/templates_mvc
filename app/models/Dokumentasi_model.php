<?php

class Dokumentasi_model
{
    private $table = 'dokumentasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Ambil semua dokumentasi
    public function getAllDokumentasi()
    {
        $query = "SELECT * FROM dokumentasi";
        $result = $this->db->query($query);

        if ($result) {
            // Misal fetchAll mengembalikan array kosong kalau tidak ada data
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        return []; // pastikan mengembalikan array kosong, bukan null
    }



    // Ambil gambar berdasarkan ID (untuk ditampilkan)
    public function getGambarById($id)
    {
        $this->db->query("SELECT gambar, tipe_gambar FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Simpan gambar ke database (upload)
    public function uploadGambar($judul, $file)
    {
        $gambar = file_get_contents($file['tmp_name']);
        $tipe_gambar = $file['type'];

        $this->db->query("INSERT INTO " . $this->table . " (judul, gambar, tipe_gambar) VALUES (:judul, :gambar, :tipe_gambar)");
        $this->db->bind('judul', $judul);
        $this->db->bind('gambar', $gambar, PDO::PARAM_LOB);
        $this->db->bind('tipe_gambar', $tipe_gambar);
        return $this->db->execute();
    }

    // Hapus gambar berdasarkan ID
    public function deleteGambar($id)
    {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
