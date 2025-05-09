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
        if($this->model('User_model')->tambahDataUser($_POST) > 0) {
           header('Location: ' . BASEURL . '/user');
           exit;
        }
    }
}