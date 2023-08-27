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

    protected $allowedFields = ['nombre', 'descripcion', 'categoria','cantidad_actual', 'canatidad_vendida', 'precio', 'fecha_public', 'estado', 'fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerProductos($estado, $id)
    {
        $this->select('tbl_productos.id_producto, tbl_param_det.nombre as categoria, tbl_productos.nombre, descripcion, cantidad_actual, precio, fecha_public, concat(tbl_usuarios.nombre_p, " ", tbl_usuarios.apellido_p) as nomCreador, tbl_img_producto.nombre_img, CAST(AVG(tbl_valoracion_producto.valoracion) AS INT) as valoracion');
        $this->join('tbl_usuarios', 'tbl_usuarios.id_usuario = tbl_productos.usuario_crea');
        $this->join('tbl_img_producto', 'tbl_img_producto.id_producto = tbl_productos.id_producto');
        $this->join('tbl_param_det', 'tbl_param_det.id_param_det = tbl_productos.categoria');
        $this->join('tbl_valoracion_producto', 'tbl_valoracion_producto.id_producto = tbl_productos.id_producto', 'left');
        $this->where('tbl_productos.estado', $estado);
        if($id != 0){
            $this->where('tbl_productos.id_producto != ', $id);
        }
        $this->groupBy('tbl_productos.id_producto');
        $data = $this->findAll();
        return $data;
    }
    public function buscarProducto($id, $nombre, $idUser)
    {
        $this->select('tbl_productos.id_producto, tbl_productos.nombre, descripcion, categoria, tbl_param_det.nombre as nomCate, cantidad_actual, precio, fecha_public, concat(tbl_usuarios.nombre_p, " ", tbl_usuarios.apellido_p) as nomCreador, tbl_img_producto.nombre_img');
        $this->join('tbl_usuarios' ,'tbl_usuarios.id_usuario = tbl_productos.usuario_crea');
        $this->join('tbl_param_det', 'tbl_param_det.id_param_det = tbl_productos.categoria');
        $this->join('tbl_img_producto', 'tbl_img_producto.id_producto = tbl_productos.id_producto');
        if($nombre != ''){
            $this->where('tbl_productos.nombre', $nombre);
            $this->where('tbl_productos.usuario_crea', $idUser);
        }else{
            $this->where('tbl_productos.id_producto', $id);
        }
        $this->groupBy('tbl_productos.id_producto');
        $data = $this->findAll();
        return $data;
    }
    public function productosCategoria($id, $categoria, $estado){
        $this->select('tbl_productos.id_producto, tbl_param_det.nombre as categoria, tbl_productos.nombre, precio, tbl_img_producto.nombre_img, CAST(AVG(tbl_valoracion_producto.valoracion) AS INT) as valoracion');
        $this->join('tbl_img_producto', 'tbl_img_producto.id_producto = tbl_productos.id_producto');
        $this->join('tbl_param_det', 'tbl_param_det.id_param_det = tbl_productos.categoria');
        $this->join('tbl_valoracion_producto', 'tbl_valoracion_producto.id_producto = tbl_productos.id_producto', 'left');
        
        if($id != 0){
            $this->where('tbl_productos.id_producto !=', $id);
        }

        $this->where('tbl_productos.categoria', $categoria);
        $this->where('tbl_productos.estado', $estado);
        $this->groupBy('tbl_productos.id_producto');
        $data = $this->findAll();
        return $data;
    }
}
