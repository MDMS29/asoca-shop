<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TelefonosModel;

class Telefonos extends BaseController
{
    protected $telefonos;
    public function __construct()
    {
        $this->telefonos = new TelefonosModel();
        helper('sistema');
    }

    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        $idTele = $this->request->getVar('idTele');
        $idUsu = $this->request->getPost('idUsuario');
        $numero = $this->request->getPost('numero');
        $prioridad = $this->request->getPost('prioridad');
        $tipoTel = $this->request->getPost('tipoTel');
        $usuarioCrea = session('id');
        $data = [
            'id_usuario' => $idUsu,
            'numero' => $numero,
            'tipo_tel' => $tipoTel,
            'prioridad_tel' => $prioridad,
            'usuario_crea' => $usuarioCrea == 0 ? 3 : session('id')
        ];
        if ($tp == 2) {
            if (strpos($idTele, 'e')) {
                $res = $this->telefonos->buscarTelefono($numero, $idUsu);
                if (!empty($res)) {
                    return json_encode(2);
                } else {
                    if ($this->telefonos->save($data)) {
                        return json_encode(1);
                    }
                }
            } else {
                if ($this->telefonos->update($idTele, $data)) {
                    return json_encode(1);
                }
            }
        } else {
            if ($this->telefonos->save($data)) {
                return json_encode(1);
            }else{
                return json_encode(2);
            }
        }
    }

    public function buscarTelefono($numero, $idUsuario)
    {
        $array = array();
        $data = $this->telefonos->buscarTelefono($numero, 0);
        array_push($array, $data);
        return json_encode($array);
    }
    public function obtenerTelefonosUser($idUsuario)
    {
        $array = array();
        $data = $this->telefonos->obtenerTelefonoUser($idUsuario);
        array_push($array, $data);
        return json_encode($array);
    }
    public function eliminarTelefono($idTelefono)
    {
        if ($this->telefonos->delete($idTelefono)) {
            return json_encode(1);
        }
    }
    public function TelefonoPrincipal($idUsuario, $tipoUsuario)
    {
        $array = array();
        $data = $this->telefonos->TelefonoPrincipal($idUsuario, $tipoUsuario);
        array_push($array, $data);
        return json_encode($array);
    }
}
