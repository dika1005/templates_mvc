<?php 

class admin extends Controller {
    public function index()
    {
        $data['judul'] = 'Home admin';
        $this->view('templates/navbar');
        $this->view('admin/index');
        $this->view('templates/footer');
    }
        public function delete()
    {

        $this->view('templates/navbar');
        $this->view('admin/delete');
        $this->view('templates/footer');
    }
        public function input()
    {

        $this->view('templates/navbar');
        $this->view('admin/input');
        $this->view('templates/footer');
    }
        public function list()
    {

        $this->view('templates/navbar');
        $this->view('admin/list');
        $this->view('templates/footer');
    }
        public function search()
    {

        $this->view('templates/navbar');
        $this->view('admin/search');
        $this->view('templates/footer');
    }

}