<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ComprasEncModel;
use App\Models\ComprasDetModel;
use App\Models\ParamDetModel;

class Compras extends BaseController
{
    protected $encCompra, $detCompra, $param;
    public function __construct()
    {
        $this->encCompra = new ComprasEncModel();
        $this->detCompra = new ComprasDetModel();
        $this->param = new ParamDetModel();
    }
    public function verDetallesCompra()
    {
        echo view('components/navbar');
        echo view('compras/detalleCompra');
        echo view('components/footer');
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
        echo view('components/footer');
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
    public function administrarCompras(){
        $param = $this->param->obtenerEstadosCompra();
        $data = ['estadosCompra' => $param];
        echo view('components/navbar');
        echo view('compras/admin/administrarCompras', $data);
        echo view('components/footer');
    }
}