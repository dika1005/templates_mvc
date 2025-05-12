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
        $data['judul'] = 'Pencarian Data'; // Set judul untuk tampilan

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nik = $_POST['nik'];

            if (empty($nik)) {
                $data['error'] = 'NIK tidak boleh kosong!';
            } else {
                // Panggil model untuk mencari data
                $hasil_dari_model = $this->model('Data_model')->findByIdentifier($nik);

                // Cek hasil dari model dan set data untuk view
                if ($hasil_dari_model) {
                    $data['hasil'] = $hasil_dari_model; // Data ditemukan, set variabel 'hasil' di array data
                } else {
                    $data['error'] = 'Data tidak ditemukan untuk NIK tersebut!'; // Data tidak ditemukan, set variabel 'error' di array data
                }
            }
        }

        // Tampilkan view. View akan memeriksa apakah $data['hasil'] atau $data['error'] ada.
        $this->view('templates/navbar', $data);
        $this->view('admin/search', $data); // Array $data berisi judul, mungkin hasil, mungkin error
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
