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
}