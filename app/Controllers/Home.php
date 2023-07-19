<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Home extends BaseController
{
    protected $productos;
    public function __construct() {
        $this->productos = new ProductosModel();
    }
    public function index()
    {
        echo view('components/navbar');
        echo view('home');
        echo view('components/footer');
    }
}
