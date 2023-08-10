<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class ValoracionModel extends Model
{
    protected $table = 'tbl_valoracion_producto'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_valoracion';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_producto', 'id_usuario','valoracion', 'comentario','estado', 'fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerComentarios($id, $estado)
    {
        $this->select("tbl_valoracion_producto.id_usuario, comentario, valoracion, concat(tbl_usuarios.nombre_p, ' ', tbl_usuarios.nombre_s, ' ', tbl_usuarios.apellido_p, ' ', tbl_usuarios.apellido_s) usuario, tbl_valoracion_producto.fecha_crea");
        $this->join('tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_valoracion_producto.id_usuario');
        $this->where('tbl_valoracion_producto.id_producto', $id);
        $this->where('tbl_valoracion_producto.comentario !=', 'null');
        $this->where('tbl_valoracion_producto.estado', $estado);
        $this->orderBy('id_valoracion', 'desc');
        $data = $this->findAll();
        return $data;
    }
}
