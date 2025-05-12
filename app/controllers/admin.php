<?php

class admin extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/index');
        $this->view('templates/footer');
    }
    public function delete()
    {
        $data['judul'] = 'Delete admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/delete');
        $this->view('templates/footer');
    }
    public function list()
    {
        $data['judul'] = 'List admin';
        $data['dataposyandu'] = $this->model('Data_model')->getAllDataPosyandu();

        $this->view('templates/navbar', $data);
        $this->view('admin/list', $data); // <-- PENTING! kirim $data ke view!
        $this->view('templates/footer');
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
    $this->view('templates/footer');
}





    public function input()
    {
        $data['judul'] = 'Input admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/input');
        $this->view('templates/footer');
    }
}
