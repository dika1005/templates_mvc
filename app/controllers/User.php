<?php

class User extends Controller
{
    public function index()
    {
        $data['judul'] = 'User';
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function detail($NIK)
    {
        $data['judul'] = 'Detail User';
        $data['user'] = $this->model('User_model')->getUserByNIK($NIK);
        $this->view('templates/header', $data);
        $this->view('user/detail', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $hasil = $this->model('User_model')->tambahDataUser($_POST);

        if ($hasil === 1) {
            $_SESSION['pesan'] = 'Registrasi berhasil! Silakan login.';
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        } elseif ($hasil === 'duplikat') {
            $_SESSION['pesan'] = 'NIK sudah terdaftar! Coba login saja.';
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        } else {
            $_SESSION['pesan'] = 'Registrasi gagal! Coba lagi ya!';
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }
}
