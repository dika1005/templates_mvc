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
        // Query INSERT INTO. Kolom 'Password' dihilangkan.
        $query = "INSERT INTO " . $this->table . "
                  (NIK, Nama, Umur, Alamat, Jk, berat_badan, tinggi_badan)
                  VALUES
                  (:NIK, :Nama, :Umur, :Alamat, :Jk, :berat_badan, :tinggi_badan)";

        // Siapkan query menggunakan objek Database
        $this->db->query($query);

        // Bind nilai-nilai dari array $data ke placeholder dalam query
        // Pastikan nama placeholder sesuai dengan query di atas.
        // Binding untuk 'Password' dihilangkan.
        // Gunakan ?? null untuk kolom yang bisa NULL di DB.
        $this->db->bind(':NIK', $data['NIK']);
        $this->db->bind(':Nama', $data['Nama']);
        $this->db->bind(':Umur', $data['Umur'] ?? null);
        $this->db->bind(':Alamat', $data['Alamat'] ?? null);
        $this->db->bind(':Jk', $data['Jk']);
        $this->db->bind(':berat_badan', $data['berat_badan'] ?? null);
        $this->db->bind(':tinggi_badan', $data['tinggi_badan'] ?? null);

        // Eksekusi query
        // !!! PERHATIAN: Error HY093 yang Anda temui kemungkinan BESAR terjadi di method execute() di class Database Anda.
        // Pastikan method execute() dan bind() di Database.php sudah benar dan kompatibel dengan PDO.
        $this->db->execute();

        // Kembalikan jumlah baris yang terpengaruh
        // Asumsi rowCount() mengembalikan jumlah baris yang diinsert (1 jika berhasil)
        return $this->db->rowCount();
    }
}
