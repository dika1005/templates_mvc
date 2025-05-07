<?php 

class Admin extends Controller {
    public function index()
    {
        $data['judul'] = 'admin';
        $data['nama'] = $this->model('User_model')->getUser();
        $this->view('templates/navbar_admin', $data);
        $this->view('hero_admin/index', $data);
        $this->view('hero_admin/delete', $data);
        $this->view('hero_admin/input', $data);
        $this->view('hero_admin/list', $data);
        $this->view('hero_admin/search', $data);
        $this->view('templates/footer');
    }
}