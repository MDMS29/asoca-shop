<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('components/navbar');
        echo view('home');
        echo view('components/footer');
    }
}
