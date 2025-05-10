<?php

class User_model
{
    private  $table = 'Users';
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

    public function getUserByNIK($NIK)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE NIK = :NIK');
        $this->db->bind('NIK', $NIK);
        return $this->db->single();
    }

    public function tambahDataUser($data)
    {
        try {
            // Pastikan nama kolom di query (NIK, Nama, Umur, Alamat, Jk)
            // sesuai dengan skema tabel 'Users' Anda.
            $query = "INSERT INTO Users (NIK, Nama, Umur, Alamat, Jk) 
                      VALUES (:NIK, :Nama, :Umur, :Alamat, :Jk)";

            $this->db->query($query); // Menyiapkan statement SQL
            $this->db->bind('NIK', $data['NIK']);
            $this->db->bind('Nama', $data['nama']);     // 'nama' dari form
            $this->db->bind('Umur', $data['umur']);     // 'umur' dari form
            $this->db->bind('Alamat', $data['alamat']); // 'alamat' dari form
            $this->db->bind('Jk', $data['gender']);   // 'gender' dari form akan disimpan ke kolom 'Jk'

            $this->db->execute(); // Mengeksekusi statement

            return 1; // Sukses
        } catch (PDOException $e) {
            // Error code 1062 adalah untuk duplicate entry (misalnya, NIK unik sudah ada)
            if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
                return 'duplikat'; // NIK sudah ada
            } else {
                // Untuk error lain, Anda bisa mencatat error detailnya untuk debugging
                // error_log("PDOException in tambahDataUser: " . $e->getMessage());
                return 0; // Error lain
            }
        } catch (Exception $e) { // Menangkap exception umum lainnya
            // error_log("Exception in tambahDataUser: " . $e->getMessage());
            return 0;
        }
    }
}
