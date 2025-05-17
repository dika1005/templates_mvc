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


    // 📊 Hitung Balita (0–5 tahun)
    public function countBalita()
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table WHERE Umur BETWEEN 0 AND 5";
        $this->db->query($query);
        return $this->db->single()['total'];
    }

    public function countIbuHamil()
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table WHERE Umur BETWEEN 23 AND 40";
        $this->db->query($query);
        return $this->db->single()['total'];
    }

    public function countLansia()
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table WHERE Umur BETWEEN 50 AND 70";
        $this->db->query($query);
        return $this->db->single()['total'];
    }

    public function testCount()
    {
        return [
            'balita' => $this->countBalita(),
            'ibuHamil' => $this->countIbuHamil(),
            'lansia' => $this->countLansia()
        ];
    }
}
