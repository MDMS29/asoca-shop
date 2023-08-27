<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'tbl_usuarios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_rol', 'nombre_p', 'nombre_s', 'apellido_p', 'apellido_s', 'tipo_user', 'tipo_documento', 'n_documento', 'direccion', 'municipio', 'departamento', 'duracion', 'foto', 'contrasena', 'estado', 'fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerUsuarios($estado, $tipoUser)
    {
        $this->select('tbl_usuarios.*, tbl_param_det.resumen as doc_res, tbl_roles.nombre as nombre_rol');
        $this->join('tbl_roles', 'tbl_roles.id_rol = tbl_usuarios.id_rol');
        $this->join('tbl_param_det', 'tbl_param_det.id_param_det = tbl_usuarios.tipo_documento');
        $this->orderBy('tbl_usuarios.id_usuario', 'desc');
        $this->where('tbl_usuarios.tipo_user', $tipoUser);
        $this->where('tbl_usuarios.estado', $estado);
        $data = $this->findAll();
        return $data;
    }


    public function buscarUsuario($id, $nIdenti)
    {
        if ($id != 0) {
            $this->select("tbl_usuarios.*,tbl_correos.correo, tbl_correos.id_correo, tbl_telefonos.id_telefono, tbl_telefonos.numero, tbl_roles.nombre as nombre_rol, tbl_param_det.nombre as tipo_Documento, concat(tbl_usuarios.nombre_p,' ', tbl_usuarios.nombre_s, ' ',tbl_usuarios.apellido_p, ' ', tbl_usuarios.apellido_s) as nomCompleto");
            $this->join('tbl_correos', 'tbl_correos.id_usuario = tbl_usuarios.id_usuario', 'left');
            $this->join('tbl_telefonos', 'tbl_telefonos.id_usuario = tbl_usuarios.id_usuario', 'left');
            $this->join('tbl_roles', 'tbl_roles.id_rol = tbl_usuarios.id_rol');
            $this->join('tbl_param_det', 'tbl_param_det.id_param_det = tbl_usuarios.tipo_documento');
            $this->where('tbl_usuarios.id_usuario', $id);
        } elseif ($nIdenti != 0) {
            $this->select("tbl_usuarios.*, concat(tbl_usuarios.nombre_p,' ', tbl_usuarios.nombre_s, ' ',tbl_usuarios.apellido_p, ' ', tbl_usuarios.apellido_s) as nomCompleto, tbl_roles.nombre as nombre_rol, tbl_roles.id_rol as idRol");
            $this->where('n_documento', $nIdenti);
            $this->join('tbl_roles', 'tbl_roles.id_rol = tbl_usuarios.id_rol');
        } elseif ($id != 0 && $nIdenti != 0) {

            $this->select('tbl_usuarios.*');
            $this->where('tbl_usuarios.id_usuario', $id);
            $this->where('n_documento', $nIdenti);
        }
        $data = $this->first();
        return $data;
    }
    public function contadorUsuarios($id)
    {
        $this->select('count(id_usuario) as n_usuario');
        $this->where('estado', 'A');
        if ($id != 0) {
            $this->where('tbl_usuarios.id_rol', $id);
        }
        $data = $this->first();
        return $data;
    }
}
