<?php

class auth extends Controller
{
    public function index()
    {
        $this->view('auth/login');
    }

    public function register()
    {
        $this->view('auth/register');
    }
}
