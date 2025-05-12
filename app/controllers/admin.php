<?php

class admin extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/index');
        $this->view('templates/footer');
    }
    public function delete()
    {
        $data['judul'] = 'Delete admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/delete');
        $this->view('templates/footer');
    }
    public function list()
    {
        $data['judul'] = 'List admin';
        $data['dataposyandu'] = $this->model('Data_model')->getAllDataPosyandu();

        $this->view('templates/navbar', $data);
        $this->view('admin/list', $data); // <-- PENTING! kirim $data ke view!
        $this->view('templates/footer');
    }




    public function search()
    {
        $data['judul'] = 'Search admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/search');
        $this->view('templates/footer');
    }

    public function input()
    {
        $data['judul'] = 'Input admin';
        $this->view('templates/navbar', $data);
        $this->view('admin/input');
        $this->view('templates/footer');
    }
}
