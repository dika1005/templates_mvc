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

    public function tambahDataPosyandu($data)
    {
        $query = "INSERT INTO " . $this->table . "
                  (NIK, Nama, Umur, Alamat, Jk, berat_badan, tinggi_badan)
                  VALUES
                  (:NIK, :Nama, :Umur, :Alamat, :Jk, :berat_badan, :tinggi_badan)";

        $this->db->query($query);

        $this->db->bind(':NIK', $data['NIK']);
        $this->db->bind(':Nama', $data['Nama']);
        $this->db->bind(':Umur', $data['Umur'] ?? null);
        $this->db->bind(':Alamat', $data['Alamat'] ?? null);
        $this->db->bind(':Jk', $data['Jk']);
        $this->db->bind(':berat_badan', $data['berat_badan'] ?? null);
        $this->db->bind(':tinggi_badan', $data['tinggi_badan'] ?? null);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusDataByNik($nik)
    {
        $query = "DELETE FROM dataposyandu WHERE NIK = :nik";
        $this->db->query($query);
        $this->db->bind('nik', $nik);
        $this->db->execute();

        return $this->db->rowCount() > 0;
    }

}
