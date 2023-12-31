<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\ValoracionModel;

class Comentarios extends BaseController
{
    protected $productos, $valoracion;
    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->valoracion = new ValoracionModel();
    }

    public function obtenerComentarios()
    {
        $id = $this->request->getPost('id');
        $estado = $this->request->getPost('estado');
        $res = $this->valoracion->obtenerComentarios($id, $estado);
        return json_encode($res);
    }

    public function insertar()
    {
        $id = $this->request->getPost('idComen');
        $tp = $this->request->getPost('tp');
        $valor = $this->request->getPost('valoracion');
        $comentario = $this->request->getPost('comentario');
        $producto = $this->request->getPost('producto');
        $usuario = session('id');

        $dataValoracion = [
            'id_producto' => $producto,
            'id_usuario' => $usuario,
            'valoracion' => $valor,
            'comentario' => $comentario,
            'usuario_crea' => $usuario
        ];

        if ($tp == 2) {
            if ($this->valoracion->update($id, $dataValoracion)) {
                return json_encode(1);
            } else {
                return json_encode(2);
            }
        } else {

            if ($this->valoracion->save($dataValoracion)) {
                return json_encode(1);
            } else {
                return json_encode(2);
            }
        }
    }
    public function buscarComentario()
    {
        $id = $this->request->getPost('idComentario');
        $res = $this->valoracion->buscarComentario($id);
        return json_encode($res);
    }
    public function camEstComen()
    {
        $id = $this->request->getPost('idComentario');
        $estado = $this->request->getPost('estado');
        if ($this->valoracion->update($id, ['estado' => $estado])) {
            return json_encode(1);
        } else {
            return json_encode(2);
        }
    }
}
