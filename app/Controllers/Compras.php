<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ComprasEncModel;
use App\Models\ComprasDetModel;

class Compras extends BaseController
{
    protected $encCompra, $detCompra;
    public function __construct()
    {
        $this->encCompra = new ComprasEncModel();
        $this->detCompra = new ComprasDetModel();
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
            'estado' => 'P',
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
        echo view('components/navbar');
        echo view('compras/misCompras');
        echo view('components/footer');
    }
    public function obtenerComprasRealizadas()
    {
        $res = $this->encCompra->obtenerComprasRealizadas(session('id'));
        return json_encode($res);
    }
    public function detallesCompra()
    {
        $id = $this->request->getPost('id');
        $res = $this->detCompra->detallesCompra($id);
        return json_encode($res);
    }
}
