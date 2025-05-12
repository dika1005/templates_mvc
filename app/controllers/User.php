<?php

class User extends Controller
{
    public function index()
    {
        session_start();

        $data['judul'] = 'User';

        // Ambil notifikasi dari session (jika ada)
        $data['message'] = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);

        $this->view('templates/navbarUser', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        // Pastikan session dimulai. Lebih baik panggil sekali di entry point aplikasi.
        // Jika belum dipanggil di sana, panggil di sini:
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Update Data';
        $data['message'] = null; // Inisialisasi variabel pesan

        // --- Handle Request POST (Saat form disubmit) ---
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // *** DEBUGGING: Lihat data yang diterima dari form ***
            // echo "<h2>Debug POST Data:</h2>";
            // var_dump($_POST);

            // Pastikan NIK ada dalam data POST sebelum memanggil model
            if (!isset($_POST['NIK']) || empty($_POST['NIK'])) {
                $_SESSION['message'] = 'Gagal memperbarui data: NIK tidak ditemukan dalam data submit!';
                // Redirect kembali ke halaman update atau halaman lain yang sesuai
                header('Location: ' . BASEURL . '/user/update');
                exit;
            }

            // Panggil method update di model
            $updateResult = $this->model('User_model')->updateDataUser($_POST);

            // *** DEBUGGING: Lihat hasil kembalian dari method update di model ***
            // echo "<h2>Debug Update Result:</h2>";
            // var_dump($updateResult);

            // Periksa hasil pembaruan dari model
            if ($updateResult > 0) {
                // Jika rowCount() > 0, berarti ada baris yang terpengaruh (berhasil diupdate)
                $_SESSION['message'] = 'Data berhasil diperbarui!';
                // Redirect ke halaman user index setelah sukses
                header('Location: ' . BASEURL . '/user');
                exit;
            } else {
                // Jika rowCount() 0, ada 2 kemungkinan: NIK tidak ditemukan ATAU data tidak berubah
                // Jika model mengembalikan nilai selain integer (misal string 'duplikat' dari tambahDataUser,
                // meskipun di updateDataUser mengembalikan int), Anda perlu tangani juga.
                // Saat ini, updateDataUser hanya mengembalikan int (0 atau rowCount) atau mencetak error.

                // Asumsi: Jika updateDataUser mengembalikan 0, itu karena NIK tidak ditemukan
                // atau data yang disubmit sama persis dengan yang ada di database.
                $_SESSION['message'] = 'Gagal memperbarui data. Data mungkin tidak berubah atau NIK tidak ditemukan.';

                // Redirect kembali ke halaman update agar user bisa mencoba lagi atau melihat data saat ini
                header('Location: ' . BASEURL . '/user/update');
                exit;
            }
        }

        // --- BAGIAN INI DIJALANKAN KETIKA HALAMAN PERTAMA KALI DIBUKA (BUKAN POST) ---

        // Ambil data user berdasarkan NIK yang tersimpan di session
        if (isset($_SESSION['nik']) && !empty($_SESSION['nik'])) {
            $data['user'] = $this->model('User_model')->findByIdentifier($_SESSION['nik']);

            // Jika data user tidak ditemukan di database berdasarkan NIK di session
            if (!$data['user']) {
                $_SESSION['message'] = 'Data pengguna tidak ditemukan. Silakan login kembali.';
                // Redirect ke halaman login
                header('Location: ' . BASEURL . '/login'); // Ganti dengan URL halaman login Anda
                exit;
            }

        } else {
            // Jika NIK tidak ada di session (user belum login?)
            $_SESSION['message'] = 'Anda harus login untuk mengakses halaman ini.';
            // Redirect ke halaman login
            header('Location: ' . BASEURL . '/login'); // Ganti dengan URL halaman login Anda
            exit;
        }

        // *** DEBUGGING: Lihat data user yang diambil dari database sebelum form ditampilkan ***
        // echo "<h2>Debug User Data Fetched:</h2>";
        // var_dump($data['user']);


        // Ambil message dari session (untuk pesan dari redirect sebelumnya, jika ada)
        // Ini akan menampilkan pesan sukses/gagal dari attempt POST sebelumnya
        $data['message'] = $_SESSION['message'] ?? null;
        unset($_SESSION['message']); // Hapus pesan setelah diambil

        // Load tampilan
        $this->view('templates/navbarUser', $data);
        $this->view('user/update', $data); // Tampilan form update
        $this->view('templates/footer');
    }

    public function jadwal()
    {
        $data['judul'] = 'Jadwal';
        $this->view('templates/navbarUser', $data);
        $this->view('user/jadwal', $data);
        $this->view('templates/footer');
    }
}
