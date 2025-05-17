<?php

class admin extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/index');
        $this->view('templates/footeradmin');
    }
    public function delete()
    {
        $data['judul'] = 'Delete admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/delete');
        $this->view('templates/footeradmin');
    }

    public function deleteByNik()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nik = $_POST['nik'];

            // Memastikan model Admin_model di-load dengan benar
            $adminModel = $this->model('Data_model'); // Memanggil model Admin_model

            // Panggil fungsi hapusDataByNik
            if ($adminModel->hapusDataByNik($nik)) {
                // Redirect jika berhasil
                header('Location: ' . BASEURL . '/admin/delete?success=1');
                exit;
            } else {
                // Redirect jika gagal
                header('Location: ' . BASEURL . '/admin/delete?error=1');
                exit;
            }
        }
    }




    public function list()
    {
        $data['judul'] = 'List admin';
        $data['dataposyandu'] = $this->model('Data_model')->getAllDataPosyandu();

        $this->view('templates/navbar', $data);
        $this->view('admin/list', $data); // <-- PENTING! kirim $data ke view!
        $this->view('templates/footeradmin');
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
        $data['balita'] = $this->model('Data_model')->countBalita();
        $data['ibuHamil'] = $this->model('Data_model')->countIbuHamil();
        $data['lansia'] = $this->model('Data_model')->countLansia();
        // Tampilkan tampilan
        $this->view('templates/navbar', $data);
        $this->view('admin/search', $data);
        $this->view('templates/footeradmin');
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
        $this->view('admin/input', $data);
        // View ini juga perlu membaca $_SESSION['pesan']
        $this->view('templates/footeradmin');
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
    public function upload()
    {
        $data['judul'] = 'upload gambar';
        $this->view('templates/navbar', $data);
        $this->view('admin/upload');
        $this->view('templates/footeradmin');
    }

    public function laporan()
    {
        // Load library FPDF
        require_once dirname(__DIR__, 2) . '/public/pdf/fpdf.php';

        // Ambil semua data dari tabel dataposyandu
        $dataPosyandu = $this->model('Data_model')->getAllDataPosyandu();

        // Buat PDF baru
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Judul
        $pdf->Cell(0, 10, 'Laporan Data Posyandu', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(5);

        // Header tabel
        $pdf->SetFillColor(173, 216, 230); // biru muda
        $pdf->SetFont('Arial', 'B', 11);

        $pdf->Cell(40, 10, 'NIK', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Nama', 1, 0, 'C', true);
        $pdf->Cell(15, 10, 'Umur', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Alamat', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'JK', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'BB (kg)', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'TB (cm)', 1, 1, 'C', true);

        // Isi tabel dari database
        $pdf->SetFont('Arial', '', 10);
        foreach ($dataPosyandu as $row) {
            $pdf->Cell(40, 10, $row['NIK'], 1, 0, 'C');
            $pdf->Cell(40, 10, $row['Nama'], 1, 0, 'C');
            $pdf->Cell(15, 10, $row['Umur'], 1, 0, 'C');
            $pdf->Cell(35, 10, $row['Alamat'], 1, 0, 'C');
            $pdf->Cell(25, 10, $row['Jk'], 1, 0, 'C');
            $pdf->Cell(20, 10, $row['berat_badan'], 1, 0, 'C');
            $pdf->Cell(20, 10, $row['tinggi_badan'], 1, 1, 'C');
        }

        // Output PDF ke browser
        $pdf->Output('I', 'Laporan_Data_Posyandu.pdf');
    }




}
