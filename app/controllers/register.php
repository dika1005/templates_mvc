<?php

class register extends Controller{
    public function index() 
    {
        $data['judul'] = 'Data diri';
        $data['dta'] =  $this->model('Data_model')->getAllData();
        $this->view('register/index', $data);
        $this->view('templates/footer');
    }
}