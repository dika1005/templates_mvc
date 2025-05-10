<?php
// Ensure session is started at the very beginning of the application
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Auth extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';

        // Check if there's a message in the session (set by procesRegistrasi or elsewhere)
        // We only want to display it once, so we retrieve and then unset it.
        if (isset($_SESSION['pesan'])) {
            $data['message'] = $_SESSION['pesan'];
            $data['message_type'] = $_SESSION['pesan_tipe'] ?? ''; // Get the type (e.g., 'sukses', 'error')

            // Unset the session variables so the message doesn't reappear
            unset($_SESSION['pesan']);
            unset($_SESSION['pesan_tipe']);
        } else {
            // Ensure these keys exist in the data array even if no message
            $data['message'] = null;
            $data['message_type'] = '';
        }

        // Pass the data array (which now includes potential message and type) to the view
        $this->view('auth/login', $data); // Assuming your framework uses $this->view('view_name', $data)
        // If your framework specifically requires the 'data:' syntax:
        // $this->view('auth/login', data: $data);

    }

    public function register()
    {
        $data['judul'] = 'Register';
        $data['form_data'] = $_SESSION['form_data'] ?? [];
        unset($_SESSION['form_data']);
        $data['pesan'] = $_SESSION['pesan'] ?? null;
        $data['pesan_tipe'] = $_SESSION['pesan_tipe'] ?? '';
        unset($_SESSION['pesan']);
        unset($_SESSION['pesan_tipe']);

        // Assuming your framework uses $this->view('view_name', $data)
        $this->view('auth/register', $data);
        // If your framework specifically requires the 'data:' syntax:
        // $this->view('auth/register', data: $data);
    }

    public function prosesRegistrasi()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $inputData = [
                'NIK'       => filter_input(INPUT_POST, 'NIK', FILTER_SANITIZE_STRING),
                'nama'      => filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING),
                'umur'      => filter_input(INPUT_POST, 'umur', FILTER_VALIDATE_INT),
                'alamat'    => filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING),
                'gender'    => filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING)
            ];

            $errors = [];
            if (empty($inputData['NIK'])) {
                $errors[] = "NIK wajib diisi.";
            }
            // Add NIK format/length validation if needed
            if (empty($inputData['nama'])) {
                $errors[] = "Nama lengkap wajib diisi.";
            }
            // Check specifically for false (failed filter) or null (not set)
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
                $_SESSION['form_data'] = $_POST; // Keep the submitted data
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }

            $userModel = $this->model('User_model');
            $hasil = $userModel->tambahDataUser($inputData);

            if ($hasil === 1) {
                $_SESSION['pesan'] = "Registrasi berhasil! Silakan login untuk melanjutkan.";
                $_SESSION['pesan_tipe'] = "sukses";
                // Redirect to the login page
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            } elseif ($hasil === 'duplikat') {
                $_SESSION['pesan'] = "Registrasi gagal! NIK yang Anda masukkan sudah terdaftar.";
                $_SESSION['pesan_tipe'] = "error";
                $_SESSION['form_data'] = $_POST; // Keep the submitted data
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            } else {
                $_SESSION['pesan'] = "Registrasi gagal! Terjadi kesalahan pada server. Silakan coba lagi.";
                $_SESSION['pesan_tipe'] = "error";
                $_SESSION['form_data'] = $_POST; // Keep the submitted data
                header('Location: ' . BASEURL . '/auth/register');
                exit;
            }
        } else {
            // If accessed via GET, redirect to the register form
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    // You would likely add a procesLogin method here later
    /*
    public function procesLogin() {
        // Logic to handle login POST requests
    }
    */

    // And maybe a logout method
    /*
    public function logout() {
        // Logic to destroy session and redirect
    }
    */
}
