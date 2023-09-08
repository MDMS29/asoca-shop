<?php

namespace App\Controllers;

use App\Models\ParamDetModel;
use App\Models\ProductosModel;

class Categorias extends BaseController
{
    protected $producto, $param;
    public function __construct()
    {
        $this->param = new ParamDetModel();
        $this->producto = new ProductosModel();
    }
    public function obtProductosCategoria($nomCate)
    {
        $tipoDocs = $this->param->obtenerTipoDocumentos();
        $data = ['tipoDocs' => $tipoDocs, 'categoria' => $nomCate];
        echo view('components/navbar', $data);
        echo view('categorias/categorias');
    }

    public function productosCategoria()
    {
        $id = $this->request->getPost('id');
        $categoria = $this->request->getPost('categoria');
        $estado = $this->request->getPost('estado');
        $res = $this->producto->productosCategoria($id, $categoria, $estado);
        if (empty($res)) {
            $res = $this->producto->obtenerProductos($estado, $id);
        }
        return json_encode($res);
    }
}
