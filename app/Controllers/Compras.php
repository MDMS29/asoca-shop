<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ComprasEncModel;
use App\Models\ComprasDetModel;
use App\Models\ParamDetModel;
use App\Models\ProductosModel;

class Compras extends BaseController
{
    protected $encCompra, $detCompra, $param, $producto;
    public function __construct()
    {
        $this->encCompra = new ComprasEncModel();
        $this->detCompra = new ComprasDetModel();
        $this->param = new ParamDetModel();
        $this->producto = new ProductosModel();
    }
    public function verDetallesCompra()
    {
        echo view('components/navbar');
        echo view('compras/detalleCompra');
    }
    public function insertar()
    {
        date_default_timezone_set('America/Bogota');
        $id = $this->request->getPost('id');
        $subtotal = $this->request->getPost('subtotal');
        $carrito = $this->request->getPost('carrito');

        $dataEnc = [
            'usuario_comprador' => session('id'),
            'subtotal' => intval($subtotal),
            'fecha_compra' => date('Y-m-d'),
            'hora_compra' => date('h:i:s'),
            'estado' => 7,
            'usuario_crea' => session('id')
        ];
        if ($id == 0) {
            if ($this->encCompra->save($dataEnc)) {
                $idEnc = $this->encCompra->getInsertID();
                foreach ($carrito as $produc) {
                    $dataDet = [
                        'id_compra_enc' => $idEnc,
                        'id_producto' => $produc['id'],
                        'cantidad' => intval($produc['cantidad']),
                        'precio' => $produc['precio'],
                        'subtotal' => intval($produc['cantidad']) * intval($produc['precio']),
                        'estado' => 'A',
                        'usuario_crea' => session('id')
                    ];
                    $this->detCompra->save($dataDet);
                }
                return json_encode(1);
            } else {
                return json_encode(2);
            }
        } else {
            // EDITAR
        }
    }
    public function verComprasRealizadas()
    {
        $param = $this->param->obtenerEstadosCompra();
        $data = ['estadosCompra' => $param];
        echo view('components/navbar');
        echo view('compras/misCompras', $data);
    }
    public function obtenerComprasRealizadas()
    {
        $estado = $this->request->getPost('estado');
        $res = $this->encCompra->obtenerComprasRealizadas($estado, session('id'));
        return json_encode($res);
    }
    public function detallesCompra()
    {
        $id = $this->request->getPost('id');
        $res = $this->detCompra->detallesCompra($id);
        return json_encode($res);
    }
    public function cancelCompra()
    {
        $id = $this->request->getPost('id');
        if ($this->encCompra->update($id, ['estado' => '6'])) {
            return json_encode(1);
        } else {
            return json_encode(2);
        }
    }
    public function actuaDetCompra()
    {
        $id = $this->request->getPost('id');
        $cantidad = $this->request->getPost('cantidad');
        $precio = $this->request->getPost('precio');
        if ($this->detCompra->update($id, ['cantidad' => $cantidad, 'subtotal' => intval($cantidad) * intval($precio)])) {
            return json_encode(1);
        } else {
            return json_encode(2);
        }
    }
    public function administrarCompras()
    {
        $param = $this->param->obtenerEstadosCompra();
        $data = ['estadosCompra' => $param];
        echo view('components/navbar');
        echo view('compras/admin/administrarCompras', $data);
    }

    public function confirProduc()
    {
        $id = $this->request->getPost('id');
        $estado = $this->request->getPost('estado');
        $cantidad = $this->request->getPost('cantidad');

        $res = $this->detCompra->buscarDetalle($id);
        if ($res != null) {
            $res = $this->producto->buscarProducto($res['id_producto'], '', 0);
            $cantidad_actual = $res[0]['cantidad_actual'] - $cantidad;
            $cantidad_vendida = intval($res[0]['cantidad_vendida']) + intval($cantidad);
            if ($this->producto->update(
                $res[0]['id_producto'],
                [
                    'cantidad_actual' => $cantidad_actual,
                    'cantidad_vendida' => $cantidad_vendida
                ]
            )) {

                if ($this->detCompra->update($id, ['estado' => $estado])) {
                    return json_encode(1);
                } else {
                    return json_encode(2);
                }
            } else {
                return json_encode(2);
            }
        }
    }
    public function cambEstadoCompra()
    {
        date_default_timezone_set('America/Bogota');
        $id = $this->request->getPost('id');
        $estado = $this->request->getPost('estado');

        if ($this->encCompra->update(
            $id,
            [
                'estado' => $estado,
                'fecha_confir' => date('Y-m-d'),
                'hora_confir' => date('h:i:s')
            ]
        )) {
            return json_encode(1);
        } else {
            return json_encode(2);
        }
    }
}
