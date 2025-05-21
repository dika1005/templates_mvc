<?php

class Controller
{
    public function view($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        } else {
            die('View tidak ditemukan: ' . $viewPath);
        }
    }


    public function model($model)
    {
        $modelPath = '../app/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model;
        } else {
            die('Model tidak ditemukan: ' . $modelPath);
        }
    }
}
