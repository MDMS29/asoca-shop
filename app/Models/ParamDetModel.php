<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class ParamDetModel extends Model
{
    protected $table = 'tbl_param_det'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_param_det';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_param_enc', 'nombre', 'resumen', 'estado', 'fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerTipoTelefono()
    {
        $this->select('id_param_det as id, nombre');
        $this->where('id_param_enc', '3');
        $data = $this->findAll();
        return $data;
    }
    public function obtenerTipoDocumentos()
    {
        $this->select('id_param_det as id, nombre');
        $this->where('id_param_enc', '1');
        $data = $this->findAll();
        return $data;
    }
    public function obtenerEstadosCompra()
    {
        $this->select('id_param_det as id, nombre');
        $this->where('id_param_enc', '4');
        $data = $this->findAll();
        return $data;
    }
    public function obtenerCategoriaProd($estado)
    {
        $this->select('id_param_det as id, nombre');
        $this->where('id_param_enc', '5');
        $this->where('estado', $estado);
        $data = $this->findAll();
        return $data;
    }
}
