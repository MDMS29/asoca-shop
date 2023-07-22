<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\ModulosModel;

class Compras extends BaseController
{
    public function verDetallesCompra()
    {
        echo view('components/navbar');
        echo view('compras/detalleCompra');
        echo view('components/footer');
    }
}
