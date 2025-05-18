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
            $adminModel = $this->model('Data_model');
            if ($adminModel->hapusDataByNik($nik)) {
                header('Location: ' . BASEURL . '/admin/delete?success=1');
                exit;
            } else {
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
        $this->view('admin/list', $data);
        $this->view('templates/footeradmin');
    }

    public function search()
    {
        session_start();
        $data['judul'] = 'Pencarian Data';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nik = $_POST['nik'];
            if (empty($nik)) {
                $_SESSION['error'] = 'NIK tidak boleh kosong!';
                unset($_SESSION['hasil']);
            } else {
                $hasil_dari_model = $this->model('Data_model')->findByIdentifier($nik);
                if ($hasil_dari_model) {
                    $_SESSION['hasil'] = $hasil_dari_model;
                    unset($_SESSION['error']);
                } else {
                    $_SESSION['error'] = 'Data tidak ditemukan untuk NIK tersebut!';
                    unset($_SESSION['hasil']);
                }
            }
            header('Location: ' . BASEURL . '/admin/search');
            exit;
        }

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

        $this->view('templates/navbar', $data);
        $this->view('admin/search', $data);
        $this->view('templates/footeradmin');
    }

    public function input()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $data['judul'] = 'Admin Data Management - Input & List';
        $data['list_data'] = $this->model('Data_model')->getAllDataPosyandu();
        $this->view('templates/navbar', $data);
        $this->view('admin/input', $data);
        $this->view('templates/footeradmin');
    }

    public function tambah()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data_baru = [
                'NIK' => $_POST['nik'] ?? '',
                'Nama' => $_POST['nama'] ?? '',
                'Umur' => $_POST['umur'] ?? null,
                'Alamat' => $_POST['alamat'] ?? null,
                'Jk' => $_POST['jk'] ?? '',
                'berat_badan' => $_POST['berat_badan'] ?? null,
                'tinggi_badan' => $_POST['tinggi_badan'] ?? null,
            ];
            if (empty($data_baru['NIK']) || empty($data_baru['Nama']) || empty($data_baru['Jk'])) {
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Data Gagal ditambahkan. Field NIK, Nama, dan Jenis Kelamin tidak boleh kosong.'];
                header('Location: ' . BASEURL . '/admin/input');
                exit;
            }
            $jumlah_baris_ditambah = $this->model('Data_model')->tambahDataPosyandu($data_baru);
            if ($jumlah_baris_ditambah > 0) {
                $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Data Posyandu berhasil ditambahkan.'];
                header('Location: ' . BASEURL . '/admin/input');
                exit;
            } else {
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Data Posyandu gagal ditambahkan. Mungkin NIK sudah terdaftar atau ada error database.'];
                header('Location: ' . BASEURL . '/admin/input');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/admin/input');
            exit;
        }
    }

    public function upload()
    {
        $data['judul'] = 'Upload Dokumentasi';
        $this->view('templates/navbar', $data);
        $this->view('admin/upload', $data);
        $this->view('templates/footeradmin', $data);
    }

    public function kirim()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $media = $_FILES['media'] ?? null;
            $data['judul'] = 'Upload Dokumentasi';
            if (!$judul || !$media || $media['error'] !== 0) {
                $data['berhasil'] = false;
                $this->view('templates/navbar', $data);
                $this->view('admin/upload', $data);
                return;
            }
            $fileData = file_get_contents($media['tmp_name']);
            $fileType = $media['type'];
            $status = $this->model('Dokumentasi_Model')->simpan([
                'judul' => $judul,
                'gambar' => $fileData,
                'tipe_gambar' => $fileType
            ]);
            $data['berhasil'] = true;
            $this->view('templates/navbar', $data);
            $this->view('admin/upload', $data);
            $this->view('templates/footeradmin', $data);
        }
    }

    public function laporan()
    {
        require_once dirname(__DIR__, 2) . '/public/pdf/fpdf.php';
        $dataPosyandu = $this->model('Data_model')->getAllDataPosyandu();
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Laporan Data Posyandu', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(5);
        $pdf->SetFillColor(173, 216, 230);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 10, 'NIK', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Nama', 1, 0, 'C', true);
        $pdf->Cell(15, 10, 'Umur', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Alamat', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'JK', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'BB (kg)', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'TB (cm)', 1, 1, 'C', true);
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
        $pdf->Output('I', 'Laporan_Data_Posyandu.pdf');
    }
}
