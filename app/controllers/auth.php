<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class Auth extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Login';

        if (isset($_SESSION['pesan'])) {
            $data['message'] = $_SESSION['pesan'];
            $data['message_type'] = $_SESSION['pesan_tipe'] ?? '';
            unset($_SESSION['pesan']);
            unset($_SESSION['pesan_tipe']);
        } else {
            $data['message'] = null;
            $data['message_type'] = '';
        }

        $this->view('auth/login', $data);
    }

    public function register()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data['judul'] = 'Register';
        $data['form_data'] = $_SESSION['form_data'] ?? [];
        unset($_SESSION['form_data']);
        $data['pesan'] = $_SESSION['pesan'] ?? null;
        $data['pesan_tipe'] = $_SESSION['pesan_tipe'] ?? '';
        unset($_SESSION['pesan']);
        unset($_SESSION['pesan_tipe']);

        $this->view('auth/register', $data);
    }


    // Fungsi untuk memproses registrasi
    public function prosesRegistrasi()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $inputData = [
                'NIK' => filter_input(INPUT_POST, 'NIK', FILTER_SANITIZE_STRING),
                'nama' => filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING),
                'password' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING),
                'umur' => filter_input(INPUT_POST, 'umur', FILTER_VALIDATE_INT),
                'alamat' => filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING),
                'gender' => filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING)
            ];

            $errors = [];
            if (empty($inputData['NIK'])) {
                $errors[] = "NIK wajib diisi.";
            }
            if (empty($inputData['nama'])) {
                $errors[] = "Nama lengkap wajib diisi.";
            }
            if (empty($inputData['password'])) {
                $errors[] = "Password wajib diisi.";
            }
            if ($inputData['umur'] === false || $inputData['umur'] === null || $inputData['umur'] <= 0) {
                $errors[] = "Umur tidak valid atau kosong.";
            }
            if (empty($inputData['alamat'])) {
                $errors[] = "Alamat wajib diisi.";
            }
            if (empty($inputData['gender'])) {
                $errors[] = "Jenis kelamin wajib dipilih.";
            }

            if (!empty($errors)) {
                $_SESSION['pesan'] = implode("<br>", $errors);
                $_SESSION['pesan_tipe'] = "error";
                $_SESSION['form_data'] = $_POST; 
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }

            $userModel = $this->model('User_model');
            $hasil = $userModel->tambahDataUser($inputData);

            if ($hasil === 1) {
                $_SESSION['pesan'] = "Registrasi berhasil! Silakan login untuk melanjutkan.";
                $_SESSION['pesan_tipe'] = "sukses";
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            } elseif ($hasil === 'duplikat') {
                $_SESSION['pesan'] = "Registrasi gagal! NIK yang Anda masukkan sudah terdaftar.";
                $_SESSION['pesan_tipe'] = "error";
                $_SESSION['form_data'] = $_POST;
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            } else {
                $_SESSION['pesan'] = "Registrasi gagal! Terjadi kesalahan pada server. Silakan coba lagi.";
                $_SESSION['pesan_tipe'] = "error";
                $_SESSION['form_data'] = $_POST;
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    // Fungsi untuk memproses login
    public function prosesLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $identifier = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($identifier) || empty($password) || empty($role)) {
                $_SESSION['pesan'] = 'Username/NIK, Password, dan Role wajib diisi!';
                $_SESSION['pesan_tipe'] = 'error';
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }

            $userModel = $this->model('User_model');
            $user = $userModel->findByIdentifier($identifier);

            if ($user && password_verify($password, $user['Password'])) {

                $_SESSION['user'] = $user;
                $_SESSION['role'] = $role;
                $_SESSION['nik'] = $user['NIK'];

                if ($role == 'admin') {
                    header('Location: ' . BASEURL . '/admin/index');
                } else {
                    header('Location: ' . BASEURL . '/user/profile'); 
                }

                exit;
            } else {
                $_SESSION['pesan'] = 'Username/NIK atau Password salah!';
                $_SESSION['pesan_tipe'] = 'error';
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }
}
