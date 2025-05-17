<?php

class Controller
{
    public function view($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data); // ⬅⬅⬅ INI YANG KRUSIAL!!!
            require_once $viewPath;
        } else {
            die('View tidak ditemukan: ' . $viewPath);
        }
    }


    public function model($model)
    {
        // Pastikan file model ada di path yang benar
        $modelPath = '../app/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model;
        } else {
            die('Model tidak ditemukan: ' . $modelPath);
        }
    }
}
