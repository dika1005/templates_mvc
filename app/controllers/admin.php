<?php 

class Admin extends Controller {
    public function index()
    {

        $this->view('templates/navbar_admin');
        $this->view('hero_admin/index');
        $this->view('templates/footer');
    }
        public function delete()
    {

        $this->view('templates/navbar_admin');
        $this->view('hero_admin/delete');
        $this->view('templates/footer');
    }
        public function input()
    {

        $this->view('templates/navbar_admin');
        $this->view('hero_admin/input');
        $this->view('templates/footer');
    }
        public function list()
    {

        $this->view('templates/navbar_admin');
        $this->view('hero_admin/list');
        $this->view('templates/footer');
    }
        public function search()
    {

        $this->view('templates/navbar_admin');
        $this->view('hero_admin/search');
        $this->view('templates/footer');
    }

}