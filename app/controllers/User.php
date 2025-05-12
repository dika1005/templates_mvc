<?php

class user extends Controller
{
    public function index()
    {
        $data['judul'] = 'User';
        $this->view('templates/navbarUser', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        $data['judul'] = 'Update Data';
        $this->view('templates/navbarUser', $data);
        $this->view('user/update', $data);
        $this->view('templates/footer');
    }

    public function jadwal()
{
    echo "Jadwal method terpanggil!";
    $data['judul'] = 'Jadwal';
    $this->view('templates/navbarUser', $data);
    $this->view('user/jadwal', $data);
    $this->view('templates/footer');
}

}
