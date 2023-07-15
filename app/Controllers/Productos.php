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
    public function insertar()
    {
        $id = $this->request->getPost('id'); 
        $tp = $this->request->getPost('tp'); 
        $nombre = $this->request->getPost('nombre'); 
        $descripcion = $this->request->getPost('descripcion'); 
        $precio = $this->request->getPost('precio'); 
        $cantidad = $this->request->getPost('cantidad'); 
        $fecha = $this->request->getPost('fecha'); 

        $dataProducto = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'cantidad_actual' =>  $cantidad,
            'precio' =>  $precio,
            'fecha_public' =>  $fecha == '' ? date('Y-m-d') : $fecha,
            'usuario_crea' => session('id')
        ];

        if($tp == 2){
            if($this->producto->update($id, $dataProducto)){
                return json_encode(1);
            }else{
                return json_encode(2);
            }
        }else{
            if($this->producto->save($dataProducto)){
                return json_encode(1);
            }else{
                return json_encode(2);
            }
        }
    }
}
