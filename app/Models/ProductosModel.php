<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = 'tbl_productos'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_producto';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'descipcion', 'cantidad', 'precio', 'fecha_public', 'valoracion', 'estado', 'fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerProductos($estado)
    {
        $this->select('nombre, descripcion, cantidad, precio, fecha_public, valoracion, concat(tbl_usuarios.nombre_p, " ", tbl_usuarios.apellido_p) as nomCreador');
        $this->join('tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_productos.usuario_crea');
        $this->where('tbl_productos.estado', $estado);
        $data = $this->findAll();
        return $data;
    }
}
