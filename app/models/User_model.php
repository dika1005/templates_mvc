<?php

class User_model
{
    private $table = 'Users';
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

    public function tambahDataUser($data)
    {
        try {
            if (!isset($data['password'])) {
                return 0;
            }

            $plainPassword = $data['password'];
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            if ($hashedPassword === false) {
                return 0;
            }

            $query = "INSERT INTO Users (NIK, Nama, Password, Umur, Alamat, Jk)
                      VALUES (:NIK, :Nama, :Password, :Umur, :Alamat, :Jk)";

            $this->db->query($query);
            $this->db->bind('NIK', $data['NIK']);
            $this->db->bind('Nama', $data['nama']);
            $this->db->bind('Password', $hashedPassword);
            $this->db->bind('Umur', $data['umur']);
            $this->db->bind('Alamat', $data['alamat']);
            $this->db->bind('Jk', $data['gender']);

            $this->db->execute();

            return 1;
        } catch (PDOException $e) {
            if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
                return 'duplikat';
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

        public function updateDataUser($data)
    {
        // Validasi data input minimal
        // Memeriksa NIK, nama, umur, alamat, dan Jk (menggunakan 'jk' sesuai form dan binding)
        // NIK juga harus ada karena untuk WHERE klausa.
        // Pastikan form user/update.php memiliki input dengan name="jk" dan name="NIK".
        if (!isset($data['NIK'], $data['nama'], $data['umur'], $data['alamat'], $data['jk'])) {
            // Data input tidak lengkap (field dasar wajib)
            return 0; // Mengembalikan 0 jika data dasar tidak lengkap
        }

        try {
            // Base UPDATE query, hanya kolom dasar yang selalu diupdate
            $query = "UPDATE " . $this->table . " SET
                      Nama = :Nama,
                      Umur = :Umur,
                      Alamat = :Alamat,
                      Jk = :Jk"; // Menggunakan placeholder :Jk

            // Tambahkan kolom opsional ke query jika datanya ada di array $data (datang dari form)
            // Controller user/update tidak mengirim tinggi/berat, tapi biarkan method ini fleksibel.
             if (isset($data['berat_badan'])) {
                 $query .= ", berat_badan = :berat_badan";
             }
             if (isset($data['tinggi_badan'])) {
                 $query .= ", tinggi_badan = :tinggi_badan";
             }
            // Periksa apakah input password baru diisi di form update
            // Pastikan form user/update.php memiliki input dengan name="password" jika ini diperlukan
            if (!empty($data['password'])) { // Menggunakan empty() untuk string kosong atau null
                 $query .= ", Password = :Password"; // Menggunakan placeholder :Password
            }


            // Tambahkan klausa WHERE untuk memilih baris yang akan diupdate berdasarkan NIK
            $query .= " WHERE NIK = :NIK";

            // --- DEBUGGING: Lihat query yang akan dijalankan (Optional) ---
            // echo "Debug Query: "; var_dump($query);


            // Siapkan query
            $this->db->query($query);

            // Binding parameter
            // Nama placeholder (misal :NIK) harus sesuai dengan query di atas.
            // Kunci array $data (misal $data['NIK']) harus sesuai dengan kunci yang diterima dari controller.
            $this->db->bind(':NIK', $data['NIK']); // NIK dari form (harus ada)
            $this->db->bind(':Nama', $data['nama']); // 'nama' dari form
            $this->db->bind(':Umur', $data['umur'] ?? null); // 'umur' dari form, gunakan ?? null
            $this->db->bind(':Alamat', $data['alamat'] ?? null); // 'alamat' dari form, gunakan ?? null
            $this->db->bind(':Jk', $data['jk']); // 'jk' dari form (dikoreksi dari 'gender' di kode Anda)

            // Binding kolom opsional/nullable jika ditambahkan ke query (cek lagi apakah ada di $data)
            if (isset($data['berat_badan'])) {
                 $this->db->bind(':berat_badan', $data['berat_badan'] ?? null); // 'berat_badan' dari form
            }
            if (isset($data['tinggi_badan'])) {
                $this->db->bind(':tinggi_badan', $data['tinggi_badan'] ?? null); // 'tinggi_badan' dari form
            }

            // Binding password jika diisi dan ditambahkan ke query
            if (!empty($data['password'])) {
                 // Hash password sebelum binding
                 $this->db->bind(':Password', password_hash($data['password'], PASSWORD_DEFAULT));
            }

            // --- DEBUGGING: Lihat parameter yang di-bind (Optional - tergantung implementasi Database class) ---
            // echo "Debug Bound Params: "; var_dump($this->db->getBoundParams()); // Asumsi method ini ada


            // Eksekusi query
            // !!! PERHATIAN: Error HY093 yang Anda temui kemungkinan besar terjadi di method execute() di class Database Anda.
            // Pastikan method execute() dan bind() di Database.php sudah benar dan kompatibel dengan PDO.
            $this->db->execute();

            // rowCount akan mengembalikan jumlah baris yang diubah.
            // Jika data yang disubmit SAMA PERSIS dengan data di database (kecuali password jika tidak diubah), rowCount bisa 0.
            // Jika NIK di klausa WHERE tidak ditemukan, rowCount juga akan 0.
            // Jadi, jika rowCount 0, ada 2 kemungkinan: NIK tidak ada ATAU data tidak berubah.
            return $this->db->rowCount();

        } catch (PDOException $e) { // Tangkap spesifik PDOException untuk error DB
            // Log error database
             error_log("Database Error in User_model::updateDataUser: " . $e->getMessage()); // Log ke PHP error log
            // echo "Database Error: " . $e->getMessage(); // Tampilkan error di browser saat debugging
            return 0; // Mengembalikan 0 jika terjadi error database
        } catch (Exception $e) { // Tangkap exception umum lainnya
            // Log error lainnya
             error_log("General Error in User_model::updateDataUser: " . $e->getMessage()); // Log ke PHP error log
            // echo "General Error: " . $e->getMessage(); // Tampilkan error di browser saat debugging
            return 0; // Mengembalikan 0 jika terjadi error lain
        }
    }
}