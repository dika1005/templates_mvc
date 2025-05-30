<?php

class User extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Halaman Utama User';
        $data['user'] = null;

        $data['message'] = $_SESSION['pesan'] ?? null;
        unset($_SESSION['pesan']);

        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            $data['user'] = $_SESSION['user'];
        }

        $this->view('templates/navbarUser', $data);
        $this->view('user/index', $data);
        $this->view('templates/footeruser');
    }

        //fungsi untuk menampilkan halaman update data pengguna
    public function update()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Update Data Pengguna';
        $data['user'] = null;
        $data['message'] = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $update_data = [
                'NIK' => $_POST['NIK'] ?? '',
                'nama' => $_POST['nama'] ?? '',
                'umur' => $_POST['umur'] ?? null,
                'alamat' => $_POST['alamat'] ?? null,
                'gender' => $_POST['gender'] ?? '',
            ];

            if (isset($_POST['password']) && !empty($_POST['password'])) {
                $update_data['password'] = $_POST['password'];
            }

            if (empty($update_data['NIK'])) {
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Gagal memperbarui data: NIK tidak boleh kosong.'];
                header('Location: ' . BASEURL . '/user/update');
                exit;
            }

            if (empty($update_data['nama']) || empty($update_data['gender'])) {
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Gagal memperbarui data: Field Nama atau Jenis Kelamin kosong.'];
                header('Location: ' . BASEURL . '/user/update');
                exit;
            }

            $updateResult = $this->model('User_model')->updateDataUser($update_data);

            if ($updateResult > 0) {
                $latest_user_data = $this->model('User_model')->findByIdentifier($update_data['NIK']);

                if ($latest_user_data) {
                    $_SESSION['user'] = $latest_user_data;
                    $_SESSION['nik'] = $latest_user_data['NIK'];
                }

                $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Data berhasil diperbarui!'];
                header('Location: ' . BASEURL . '/user');
                exit;
            } else {
                $_SESSION['pesan'] = ['tipe' => 'warning', 'isi' => 'Data tidak berubah atau pengguna dengan NIK tersebut tidak ditemukan.'];
                header('Location: ' . BASEURL . '/user/update');
                exit;
            }
        } else {
            if (isset($_SESSION['nik']) && !empty($_SESSION['nik'])) {
                $user_nik = $_SESSION['nik'];
                $data['user'] = $this->model('User_model')->findByIdentifier($user_nik);

                if (!$data['user']) {
                    $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Data pengguna tidak ditemukan. Silakan login kembali.'];
                    header('Location: ' . BASEURL . '/login');
                    exit;
                }
            } else {
                $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Anda harus login untuk mengakses halaman ini.'];
                header('Location: ' . BASEURL . '/login');
                exit;
            }

            $data['message'] = $_SESSION['pesan'] ?? null;
            unset($_SESSION['pesan']);

            $this->view('templates/navbarUser', $data);
            $this->view('user/update', $data);
            $this->view('templates/footeruser');
        }
    }

    //fungsi untuk menampilkan jadwal
    public function jadwal()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Jadwal Posyandu';

        $this->view('templates/navbarUser', $data);
        $this->view('user/jadwal', $data);
        $this->view('templates/footeruser');
    }

    //fungsi untuk menampilkan dokumentasi
    public function dokumentasi()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Dokumentasi Posyandu';

        $dokumentasiModel = $this->model('Dokumentasi_model');
        $data['dokumentasi'] = $dokumentasiModel->getAllDokumentasi();

        $this->view('templates/navbarUser', $data);
        $this->view('user/dokumentasi', $data);
        $this->view('templates/footeruser');
    }
    //fungsi untuk menampilkan gambar
    public function getGambar($id)
    {
        $dokumentasiModel = $this->model('Dokumentasi_model');
        $gambarData = $dokumentasiModel->getGambarById($id);

        if ($gambarData) {
            header("Content-Type: " . $gambarData['tipe_gambar']);
            echo $gambarData['gambar'];
        } else {
            http_response_code(404);
            echo "Gambar tidak ditemukan.";
        }
    }

    //fungsi untuk mengunggah gambar
    public function uploadDokumentasi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['gambar'])) {
            $judul = $_POST['judul'];
            $file = $_FILES['gambar'];

            $dokumentasiModel = $this->model('Dokumentasi_model');

            if ($dokumentasiModel->uploadGambar($judul, $file)) {
                $_SESSION['pesan'] = "Gambar berhasil diunggah.";
            } else {
                $_SESSION['pesan'] = "Gagal mengunggah gambar.";
            }

            header("Location: " . BASEURL . "/user/dokumentasi");
            exit;
        }

        $data['judul'] = 'Unggah Dokumentasi';
        $this->view('templates/navbarUser', $data);
        $this->view('user/upload_dokumentasi', $data);
        $this->view('templates/footeruser');
    }

    //fungsi untuk menghapus gambar
    public function deleteDokumentasi($id)
    {
        $dokumentasiModel = $this->model('Dokumentasi_model');

        if ($dokumentasiModel->deleteGambar($id)) {
            $_SESSION['pesan'] = "Gambar berhasil dihapus.";
        } else {
            $_SESSION['pesan'] = "Gagal menghapus gambar.";
        }

        header("Location: " . BASEURL . "/user/dokumentasi");
        exit;
    }
}
