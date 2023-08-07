<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class ComprasDetModel extends Model
{
    protected $table = 'tbl_compras_det'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_compra_det';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_compra_enc', 'id_producto', 'cantidad', 'precio', 'subtotal', 'observacion', 'estado','fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function detallesCompra($id){
        $this->select('tbl_productos.nombre, tbl_compras_det.cantidad, tbl_compras_det.precio, tbl_compras_det.subtotal, tbl_compras_enc.fecha_compra,tbl_compras_enc.hora_compra, tbl_compras_enc.subtotal as totalCompra, tbl_compras_det.id_compra_det, tbl_compras_enc.estado, tbl_compras_det.observacion, tbl_compras_det.estado as estadoPro');
        
        $this->join('tbl_productos', 'tbl_productos.id_producto = tbl_compras_det.id_producto');
        $this->join('tbl_compras_enc', 'tbl_compras_enc.id_compra_enc = tbl_compras_det.id_compra_enc');
        $this->where('tbl_compras_det.id_compra_enc', $id);
        $data = $this->findAll();
        return $data;
    }

}
