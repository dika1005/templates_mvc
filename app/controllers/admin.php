<?php

class admin extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/index');
        // $this->view('templates/footer');
    }
    public function delete()
    {
        $data['judul'] = 'Delete admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/delete');
        // $this->view('templates/footer');
    }
    public function list()
    {
        $data['judul'] = 'List admin';
        $data['dataposyandu'] = $this->model('Data_model')->getAllDataPosyandu();

        $this->view('templates/navbar', $data);
        $this->view('admin/list', $data); // <-- PENTING! kirim $data ke view!
        // $this->view('templates/footer');
    }


    public function search()
    {
        session_start(); // ⛔️ Penting! Pastikan session dimulai

        $data['judul'] = 'Pencarian Data';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nik = $_POST['nik'];

            if (empty($nik)) {
                $_SESSION['error'] = 'NIK tidak boleh kosong!';
            } else {
                $hasil_dari_model = $this->model('Data_model')->findByIdentifier($nik);

                if ($hasil_dari_model) {
                    $_SESSION['hasil'] = $hasil_dari_model;
                } else {
                    $_SESSION['error'] = 'Data tidak ditemukan untuk NIK tersebut!';
                }
            }

            // Redirect untuk mencegah form resubmission dan bersihkan data setelah refresh
            header('Location: ' . BASEURL . '/admin/search');
            exit;
        }

        // Tarik data dari session jika ada
        if (isset($_SESSION['hasil'])) {
            $data['hasil'] = $_SESSION['hasil'];
            unset($_SESSION['hasil']);
        }

        if (isset($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        // Tampilkan tampilan
        $this->view('templates/navbar', $data);
        $this->view('admin/search', $data);
        // $this->view('templates/footer');
    }

    public function input()
    {
        // Pastikan session dimulai jika belum
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Admin Data Management - Input & List'; // Judul halaman

        // Ambil SEMUA data untuk ditampilkan di tabel daftar pada view yang sama
        // View akan mengakses ini sebagai $data['list_data']
        $data['list_data'] = $this->model('Data_model')->getAllDataPosyandu();

        $this->view('templates/navbar', $data);
        // Pass $data yang sekarang berisi judul dan list_data ke view
        $this->view('admin/input', $data); // View ini juga perlu membaca $_SESSION['pesan']
        // $this->view('templates/footer'); // Jika perlu footer
    }

    // Method ini untuk MEMPROSES DATA DARI FORM INPUT (menangani request POST dari form di view input)
    public function tambah()
    {
        // Pastikan session dimulai jika belum
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Pastikan request datang dari method POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // --- 1. Ambil data dari $_POST ---
            // Pastikan nama kunci sesuai dengan atribut 'name' di form HTML pada view input
            // Kolom 'Password' diabaikan sesuai permintaan
            $data_baru = [
                'NIK' => $_POST['nik'] ?? '',
                'Nama' => $_POST['nama'] ?? '',
                // Password tidak diambil atau diproses
                'Umur' => $_POST['umur'] ?? null,
                'Alamat' => $_POST['alamat'] ?? null,
                'Jk' => $_POST['jk'] ?? '', // Sesuaikan name="jk" di form
                'berat_badan' => $_POST['berat_badan'] ?? null, // Sesuaikan name="berat_badan" di form
                'tinggi_badan' => $_POST['tinggi_badan'] ?? null, // Sesuaikan name="tinggi_badan" di form
            ];

            // --- 2. Validasi Data (Contoh Sederhana) ---
            // Validasi NIK, Nama, Jk (Password tidak lagi wajib)
            if (empty($data_baru['NIK']) || empty($data_baru['Nama']) || empty($data_baru['Jk'])) {
                // Set pesan error di session
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Data Gagal ditambahkan. Field NIK, Nama, dan Jenis Kelamin tidak boleh kosong.'];
                // Redirect kembali ke halaman input form
                header('Location: ' . BASEURL . '/admin/input');
                exit; // Penting untuk menghentikan eksekusi setelah redirect
            }

            // --- 3. Hash Password (Langkah ini dihilangkan sepenuhnya) ---


            // --- 4. Panggil Model untuk Menyimpan Data ---
            // Panggil fungsi tambahDataPosyandu di Data_model (versi tanpa password)
            // !!! PERHATIAN: Error HY093 kemungkinan terjadi DI SINI, di dalam method ini, karena masalah Database.php Anda.
            $jumlah_baris_ditambah = $this->model('Data_model')->tambahDataPosyandu($data_baru);


            // --- 5. Beri Feedback via Session dan Redirect ---
            if ($jumlah_baris_ditambah > 0) {
                // Data berhasil ditambahkan, set pesan success di session
                $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Data Posyandu berhasil ditambahkan.'];
                // Redirect kembali ke halaman input & list
                header('Location: ' . BASEURL . '/admin/input');
                exit; // Penting untuk menghentikan eksekusi setelah redirect
            } else {
                // Data gagal ditambahkan (misal: NIK duplikat jika unique key, error DB lain)
                // Anda mungkin perlu menangani error spesifik jika model memberikan info lebih
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Data Posyandu gagal ditambahkan. Mungkin NIK sudah terdaftar atau ada error database.'];
                // Redirect kembali ke halaman input form
                header('Location: ' . BASEURL . '/admin/input');
                exit; // Penting untuk menghentikan eksekusi setelah redirect
            }
        } else {
            // Jika method bukan POST (misal, user akses langsung URL /admin/tambah)
            // Redirect ke halaman input
            header('Location: ' . BASEURL . '/admin/input');
            exit;
        }
    }
}
