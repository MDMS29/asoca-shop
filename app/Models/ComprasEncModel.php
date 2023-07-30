<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class ComprasEncModel extends Model
{
    protected $table = 'tbl_compras_enc'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_compra_enc';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['usuario_comprador', 'metodo_pago', 'subtotal', 'fecha_compra', 'hora_compra', 'estado','fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    
    public function obtenerComprasRealizadas($estado, $usuario){
        $this->select('tbl_compras_enc.id_compra_enc, tbl_compras_enc.subtotal, tbl_compras_enc.fecha_compra, tbl_compras_enc.hora_compra, SUM(tbl_compras_det.cantidad) as numProductos, tbl_compras_enc.estado');

        $this->join('tbl_compras_det', 'tbl_compras_enc.id_compra_enc = tbl_compras_det.id_compra_enc');
        $this->where('tbl_compras_enc.usuario_comprador', $usuario);
        if($estado == 'A'){
            $this->where('tbl_compras_enc.estado !=', 'I');
        }
        $this->groupBy('tbl_compras_enc.id_compra_enc');
        $data = $this->findAll();
        return $data;
    }
}
