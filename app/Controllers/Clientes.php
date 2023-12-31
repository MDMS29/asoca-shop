<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\ModulosModel;

class Clientes extends BaseController
{
    protected $usuarios, $roles, $modulos;
    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
        $this->roles = new RolesModel();
        $this->modulos = new ModulosModel();
    }

    public function login()
    {
        $nIdenti = $this->request->getPost('usuario');
        $contrasena = $this->request->getVar('contrasena');
        $datos = $this->usuarios->buscarUsuario(0, $nIdenti);
        $modulos = $this->modulos->obtenerModulos($datos['idRol']);
        $data = [
            "id" => $datos['id_usuario'],
            "nombre" => $datos['nombre_p'],
            "apellido" => $datos['apellido_p'],
            "idRol" => $datos['idRol'],
            "rol" => $datos['nombre_rol'],
            "nomCompleto" => $datos['nomCompleto'],
            "modulos" => $modulos
        ];
        if (!empty($usuario) && !empty($contrasena)) {
            if (!empty($datos) && password_verify($contrasena, $datos['contrasena'])) {
                $session = session();
                $session->set($data);
                return json_encode(1);
            } else {
                return json_encode(2);
            }
        } else {
            if (!empty($datos) && password_verify($contrasena, $datos['contrasena'])) {
                $session = session();
                $session->set($data);
                return json_encode(1);
            } else {
                return json_encode(2);
            }
        }
    }
    public function salir()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
    public function obtenerClientes()
    {
        $tipoUser = $this->request->getPost('tipoUser');
        $estado = $this->request->getPost('estado');
        $res = $this->usuarios->obtenerUsuarios($estado, $tipoUser);
        return json_encode($res);
    }
    public function index()
    {
        $roles = $this->roles->obtenerRoles();
        $data = ['roles' => $roles];
        echo view('components/navbar');
        echo view('clientes/clientes', $data);
    }

    // public function perfil($id)
    // {
    //     $trabajadores = $this->trabajadores->contadorTrabajadores(0);
    //     $vehiculos = $this->vehiculos->contadorVehiculos(0);
    //     $ordenes = $this->ordenes->obtenerUltimaOrden();
    //     $countUsu = $this->usuarios->contadorUsuarios(0);
    //     $cargos = $this->cargos->obtenerCargos();
    //     $estVehi = $this->param->obtenerEstadosVehi('A');
    //     $categorias = $this->param->obtenerCategorias();
    //     $roles = $this->roles->obtenerRoles();
    //     $insumos = $this->materiales->contadorInsumos(0);
    //     $respuestos = $this->materiales->contadorRepuestos(0);
    //     $estantes = $this->estantes->traerBodega();
    //     $marcas = $this->marcas->obtenerMarcas();
    //     $usuarios = $this->usuarios->buscarUsuario($id, 0);
    //     $telefonos = $this->telefonos->obtenerTelefonoUser($id, 7);
    //     $correos = $this->correos->obtenerEmailUser($id, 7);
    //     $permisos = $this->permisos->obtenerPermisos(session('idRol'));
    //     $data = ['usuario' => $usuarios, 'telefonos' => $telefonos, 'correos' => $correos, 'countTraba' => $trabajadores, 'countVehi' => $vehiculos, 'countOrden' => $ordenes, 'countUsuario' => $countUsu, 'cargos' => $cargos, 'estadoVehi' => $estVehi, 'roles' => $roles, 'marcas' => $marcas, 'permisos' => $permisos, 'categorias' => $categorias, 'countInsumo' => $insumos, 'countRepuestos' => $respuestos, 'estantes' => $estantes];
    //     echo view('principal/sidebar');
    //     echo view('usuarios/perfil', $data);
    // }
    // public function mostrarImagen($id)
    // {
    //     $res = $this->usuarios->buscarUsuario($id, 0);
    //     if ($res['foto'] == '') {
    //         $rutaImagen = '/uploads/fotoUser/default.png';
    //         $rutaCompleta = WRITEPATH . $rutaImagen;
    //     } else {
    //         $rutaImagen = '/uploads/' . $res['foto'];
    //         $rutaCompleta = WRITEPATH . $rutaImagen;
    //     }

    //     $fp = fopen($rutaCompleta, 'rb');

    //     header("Content-Type: image/png");
    //     header("Content-Length: " . filesize($rutaCompleta));
    //     fpassthru($fp);
    // }


    // public function insertarFotoPerfil()
    // {
    //     $idUser = $this->request->getPost('id');
    //     $nombreP = $this->request->getPost('nombreP');
    //     $foto = $this->request->getFile('foto');
    //     $res = $this->usuarios->buscarUsuario($idUser, 0);

    //     $foto->isValid() && !$foto->hasMoved();

    //     $rutaImagen = $res['foto'];
    //     $newName = $idUser . $nombreP . '.png'; //Nombre de imagen

    //     $uploadPath = 'fotoUser';

    //     if (!is_dir($uploadPath)) { // Verificar si el directorio existe, si no, crearlo
    //         mkdir($uploadPath, 0777, true);
    //     }
    //     $foto->store($uploadPath, $newName); // Guardar el archivo en el directorio

    //     $rutaImagen = 'fotoUser/' . $foto->getName(); // Obtener la ruta de la imagen guardada
    //     $usuarioUpdate = [
    //         'foto' => $rutaImagen
    //     ];

    //     $this->usuarios->update($idUser, $usuarioUpdate);
    //     return $idUser;
    // }
    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        $idUser = $this->request->getPost('id');
        $tipoUser = $this->request->getPost('tipoUser');
        $nombreP = $this->request->getPost('nombreP');
        $nombreS = $this->request->getPost('nombreS');
        $apellidoP = $this->request->getPost('apellidoP');
        $apellidoS = $this->request->getPost('apellidoS');
        $tipoDoc = $this->request->getPost('tipoDoc');
        $nIdenti = $this->request->getPost('nIdenti');
        $rol = $this->request->getVar('rol');
        $contra = $this->request->getVar('contra');

        $foto = $this->request->getFile('foto');
        $res = $this->usuarios->buscarUsuario($idUser, 0);

        if ($foto == null && $tp == 1) {
            $rutaImagen = 'fotoUser/default.png';
        } else if ($foto == null && $tp == 2) {
            $rutaImagen = $res['foto'];
        } else if ($foto->isValid() && !$foto->hasMoved()) {

            $newName = $idUser . $nombreP . '.png'; //Nombre de imagen
            $uploadPath = 'fotoUser';
            if (!is_dir($uploadPath)) { // Verificar si el directorio existe, si no, crearlo
                mkdir($uploadPath, 0777, true);
            }
            $foto->store($uploadPath, $newName); // Guardar el archivo en el directorio
            $rutaImagen = 'fotoUser/' . $foto->getName(); // Obtener la ruta de la imagen guardada
        }
        if ($tp == 2) {
            //Actualizar datos
            $contra = $res['contrasena'];
            $usuarioUpdate = [
                'id_rol' => $rol,
                'tipo_user' => $tipoUser,
                'tipo_doc' => $tipoDoc,
                'n_identificacion' => $nIdenti,
                'nombre_p' => $nombreP,
                'nombre_s' => $nombreS,
                'apellido_p' => $apellidoP,
                'apellido_s' => $apellidoS,
                'foto' => $rutaImagen,
                'contrasena' => $contra
            ];
            $this->usuarios->update($idUser, $usuarioUpdate);
            return $idUser;
        } else {
            //Insertar datos
            //Si la respuesta esta vacia - guardar
            $usuarioSave = [
                'id_rol' => $rol,
                'tipo_user' => $tipoUser,
                'tipo_documento' => $tipoDoc,
                'n_documento' => $nIdenti,
                'nombre_p' => $nombreP,
                'nombre_s' => $nombreS,
                'apellido_p' => $apellidoP,
                'apellido_s' => $apellidoS,
                'foto' => $rutaImagen,
                'contrasena' => password_hash($contra, PASSWORD_DEFAULT)
            ];
            $this->usuarios->save($usuarioSave);
            return json_encode($this->usuarios->getInsertID());
        }
    }
    // public function cambiarContrasena()
    // {
    //     $idUser = $this->request->getPost('idUsuario');
    //     $contra = $this->request->getVar('contra');
    //     $contrConfir = $this->request->getVar('contraConfir');

    //     $res = $this->usuarios->buscarUsuario($idUser, 0);
    //     //Si la contraseña esta vacia no se actualiza
    //     if ($contra != '') {
    //         //Verifica que no sea la misma de antes
    //         $contraHash = password_verify($contra, $res['contrasena']);
    //         if (!$contraHash) {
    //             $contra = password_hash($contra, PASSWORD_DEFAULT); //Hasheo nuevo
    //         }
    //     } else {
    //         $contra = $res['contrasena'];
    //     }
    //     if ($this->usuarios->update($idUser, ['contrasena' => $contra])) {
    //         return json_encode(1);
    //     } else {
    //         return json_encode(2);
    //     }
    // }
    public function buscarUsuario($id, $nIdenti)
    {
        $array = array();
        if ($id != 0) {
            $data = $this->usuarios->buscarUsuario($id, 0);
            if (!empty($data)) {
                array_push($array, $data);
                return json_encode($array);
            }
        } else if ($nIdenti != 0) {
            $data = $this->usuarios->buscarUsuario(0, $nIdenti);
            array_push($array, $data);
            return json_encode($array);
        } else if ($id != 0 && $nIdenti != 0) {
            $data = $this->usuarios->buscarUsuario($id, $nIdenti);
            array_push($array, $data);
            return json_encode($array);
        }
    }
    public function cambiarEstado()
    {
        $id = $this->request->getPost('id');
        $estado = $this->request->getPost('estado');
        if ($this->usuarios->update($id, ['estado' => $estado])) {
            if ($estado == 'A') {
                return '¡Se ha reestablecido el Usuario!';
            } else {
                return '¡Se ha eliminado el Usuario!';
            }
        }
    }
    // public function eliminados()
    // {
    //     $param = $this->param->obtenerTipoDoc();
    //     $roles = $this->roles->obtenerRoles();
    //     $data = ['tipoDoc' => $param, 'roles' => $roles];
    //     echo view('principal/sidebar');
    //     echo view('usuarios/eliminados', $data);
    // }
    // public function contadorUsuarios()
    // {
    //     $id = $this->request->getPost('id');
    //     $res = $this->usuarios->contadorUsuarios($id);
    //     return json_encode($res);
    // }
}
