<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProductosModel;

class Productos extends BaseController
{
    protected $producto;
    public function __construct()
    {
        $this->producto = new ProductosModel();
    }

    public function obtenerProductos()
    {
        $res = $this->producto->obtenerProductos('A');
        return json_encode($res);
    }
    public function adminProductos()
    {
        echo view('components/navbar');
        echo view('productos/adminProductos');
        echo view('components/footer');
    }
    public function buscarProducto()
    {
        $id = $this->request->getPost('id');
        $res = $this->producto->buscarProducto($id);
        return json_encode($res);
    }
}
