<?php

class auth extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('auth/login' , $data);
    }

    public function register()
    {
        $data['judul'] = 'Register';
        $this->view('auth/register', $data);
    }
}
