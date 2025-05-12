<?php

class User extends Controller
{
    public function index()
    {
        // Pastikan session dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Halaman Utama User'; // Judul halaman
        $data['user'] = null; // Inisialisasi data user

        // Mengambil pesan flash dari $_SESSION['pesan'] (format array)
        // dan menyiapkannya untuk tampilan di $data['message']
        $data['message'] = $_SESSION['pesan'] ?? null;
        unset($_SESSION['pesan']); // Hapus pesan dari session setelah diambil

        // Ambil data user dari session jika sudah login
        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            // Opsional: Redirect ke halaman login jika user belum login
            // $_SESSION['pesan'] = ['tipe' => 'warning', 'isi' => 'Anda harus login untuk mengakses halaman ini.'];
            // header('Location: ' . BASEURL . '/auth/login');
            // exit;
            // Atau biarkan halaman tampil kosong datanya jika user belum login
            // Jika Anda memilih membiarkan kosong, pastikan tampilan user/index.php
            // menangani kasus ketika $data['user'] adalah null.
        }

        // Load tampilan
        $this->view('templates/navbarUser', $data); // Navbar
        $this->view('user/index', $data);        // Tampilan utama user dengan data
        $this->view('templates/footer');           // Footer
    }

    public function update()
    {
        // Pastikan session dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Update Data Pengguna';
        $data['user'] = null;
        // $data['message'] akan diisi dari $_SESSION['pesan'] di bagian non-POST untuk tampilan
        $data['message'] = null;

        // --- Handle Request POST (Saat form disubmit) ---
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari POST dan siapkan array untuk update
            $update_data = [
                'NIK' => $_POST['NIK'] ?? '',
                'nama' => $_POST['nama'] ?? '',
                'umur' => $_POST['umur'] ?? null, // Umur bisa null sesuai DB schema
                'alamat' => $_POST['alamat'] ?? null, // Alamat bisa null sesuai DB schema
                'gender' => $_POST['gender'] ?? '', // Mengambil dari $_POST['gender'] (sesuai nama input form)
            ];

            // Tambahkan password baru ke array update_data jika diisi
            if (isset($_POST['password']) && !empty($_POST['password'])) {
                $update_data['password'] = $_POST['password'];
            }

            // Validasi NIK (penting untuk klausa WHERE di model)
            if (empty($update_data['NIK'])) {
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Gagal memperbarui data: NIK tidak boleh kosong.'];
                header('Location: ' . BASEURL . '/user/update');
                exit;
            }

            // Validasi field wajib lainnya (Nama, Jenis Kelamin)
            if (empty($update_data['nama']) || empty($update_data['gender'])) { // Cek $update_data['gender']
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Gagal memperbarui data: Field Nama atau Jenis Kelamin kosong.'];
                header('Location: ' . BASEURL . '/user/update');
                exit;
            }

            // Panggil method updateDataUser di model User_model
            $updateResult = $this->model('User_model')->updateDataUser($update_data); // Memanggil User_model

            if ($updateResult > 0) {
                // Data berhasil diperbarui di database!

                // >>> LANGKAH PENTING: Ambil data pengguna terbaru dari database
                // Gunakan NIK yang sama dengan yang digunakan untuk update
                $latest_user_data = $this->model('User_model')->findByIdentifier($update_data['NIK']); // Memanggil User_model

                // >>> LANGKAH PENTING: Perbarui data pengguna di dalam session
                // Ini memastikan halaman index dan halaman lain yang pakai session akan menampilkan data terbaru
                if ($latest_user_data) {
                    $_SESSION['user'] = $latest_user_data; // Session user di-update di sini
                    // Mungkin juga perbarui $_SESSION['nik'] jika NIK bisa berubah (meskipun biasanya NIK adalah kunci utama dan tidak berubah)
                    $_SESSION['nik'] = $latest_user_data['NIK'];
                }
                // Jika data terbaru gagal diambil (sangat jarang jika update berhasil),
                // session user tetap menggunakan data lama. Logging bisa ditambahkan di sini.


                $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Data berhasil diperbarui!'];
                header('Location: ' . BASEURL . '/user'); // Redirect ke halaman user index
                exit;
            } else {
                // Jika rowCount 0, NIK tidak ditemukan atau data tidak berubah
                // Pesan ini akan ditangkap oleh tampilan user/update.php setelah redirect
                $_SESSION['pesan'] = ['tipe' => 'warning', 'isi' => 'Data tidak berubah atau pengguna dengan NIK tersebut tidak ditemukan.'];
                header('Location: ' . BASEURL . '/user/update'); // Redirect kembali ke halaman update
                exit;
            }
        } else {
            // --- BAGIAN INI DIJALANKAN KETIKA HALAMAN PERTAMA KALI DIBUKA (BUKAN POST) ---

            // Ambil data user berdasarkan NIK yang tersimpan di session
            if (isset($_SESSION['nik']) && !empty($_SESSION['nik'])) {
                $user_nik = $_SESSION['nik'];

                // Panggil method findByIdentifier di model User_model
                $data['user'] = $this->model('User_model')->findByIdentifier($user_nik); // Memanggil User_model

                // Jika data user tidak ditemukan di database berdasarkan NIK di session
                if (!$data['user']) {
                    $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Data pengguna tidak ditemukan. Silakan login kembali.'];
                    header('Location: ' . BASEURL . '/login'); // Redirect ke halaman login
                    exit;
                }
            } else {
                // Jika NIK tidak ada di session (user belum login?)
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Anda harus login untuk mengakses halaman ini.'];
                header('Location: ' . BASEURL . '/login'); // Redirect ke halaman login
                exit;
            }

            // Mengambil pesan dari $_SESSION['pesan'] ke $data['message'] untuk tampilan
            // Tampilan user/update.php akan membaca pesan dari $data['message']
            $data['message'] = $_SESSION['pesan'] ?? null;
            unset($_SESSION['pesan']); // Hapus dari session setelah diambil

            // Load tampilan
            $this->view('templates/navbarUser', $data);
            $this->view('user/update', $data); // Tampilan form update
            $this->view('templates/footer');
        }
    }


    public function jadwal()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Jadwal Posyandu';

        $this->view('templates/navbarUser', $data);
        $this->view('user/jadwal', $data);
        $this->view('templates/footer');
    }
}
