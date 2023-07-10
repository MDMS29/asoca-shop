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
        $productos = $this->productos->obtenerProductos('A');
        $data = ['productos' => $productos];
        echo view('components/navbar');
        echo view('home', $data);
        echo view('components/footer');
    }
}
