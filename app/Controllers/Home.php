<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\ParamDetModel;

class Home extends BaseController
{
    protected $productos, $param;
    public function __construct()
    {
        $this->param = new ParamDetModel();
        $this->productos = new ProductosModel();
    }
    public function index()
    {
        $categorias = $this->param->obtenerCategoriaProd('A');
        $tipoDocs = $this->param->obtenerTipoDocumentos();
        $data = ['tipoDocs' => $tipoDocs, 'categorias' => $categorias];
        echo view('components/navbar', $data);
        echo view('home');
        echo view('components/footer');
    }
}
