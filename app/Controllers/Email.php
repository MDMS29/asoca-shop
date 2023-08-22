<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailModel;

class Email extends BaseController
{
    protected $email;
    public function __construct()
    {
        $this->email = new EmailModel();
        helper('sistema');
    }

    public function insertar()
    {
        $tp = $this->request->getPost('tp'); 
        $idCorreo = $this->request->getVar('idCorreo');
        $idUsu = $this->request->getPost('idUsuario');
        $email = $this->request->getPost('correo');
        $prioridad = $this->request->getPost('prioridad');
        $usuarioCrea = session('id') != 0 ? session('id') : 3;
        $data = [
            'id_usuario' => $idUsu,
            'correo' => $email,
            'prioridad_crr' => $prioridad,
            'usuario_crea' => $usuarioCrea
        ];
        if ($tp == 2) {
            if (strpos($idCorreo, 'e')) { 
                $res = $this->email->buscarEmail($email, $idUsu);
                if (!empty($res)) {
                    return json_encode(2);
                } else {
                    if ($this->email->save($data)) {
                        return json_encode(1);
                    }
                }
            } else {
                if ($this->email->update($idCorreo, $data)) {
                    return json_encode(1);
                }
            }
        } else {
            if ($this->email->save($data)) {
                return json_encode(1);
            }
        }
    }
    public function buscarEmail($correo, $idUsuario)
    {
        $array = array();
        $data = $this->email->buscarEmail($correo, 0);
        array_push($array, $data);
        return json_encode($array);
    }
    public function obtenerEmailUser($idUsuario)
    {
        $array = array();
        $data = $this->email->obtenerEmailUser($idUsuario);
        array_push($array, $data);
        return json_encode($array);
    }
    public function eliminarEmail($idCorreo)
    {
        if ($this->email->delete($idCorreo)) {
            return json_encode(1);
        }
    }
    public function EmailPrincipal($idUsuario)
    {
        $array = array();
        $data = $this->email->EmailPrincipal($idUsuario);
        array_push($array, $data);
        return json_encode($array);
    }
}
