<?php 

class admin extends Controller {
    public function index()
    {
        $data['judul'] = 'Home admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/index');
        $this->view('templates/footer');
    }
}