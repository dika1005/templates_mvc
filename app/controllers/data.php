<?php

class data extends Controller{
    public function index() 
    {
        $data['judul'] = 'Data diri';
        $data['dta'] =  $this->model('Data_model')->getAllData();
        $this->view('templates/header', $data);
        $this->view('data/index', $data);
        $this->view('templates/footer');
    }
    
    public function detail($id) 
    {
        $data['judul'] = 'Detail Data';
        $data['dta'] =  $this->model('Data_model')->getDataById($id);
        $this->view('templates/header', $data);
        $this->view('data/detail', $data);
        $this->view('templates/footer');
    }

    public function tambah() 
    {
        $data['judul'] = 'Tambah Data';
        $this->view('templates/header', $data);
        $this->view('data/tambah', $data);
        $this->view('templates/footer');
    }
}