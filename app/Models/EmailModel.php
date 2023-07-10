<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class EmailModel extends Model
{
    protected $table = 'tbl_correos'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_correo';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_usuario', 'correo', 'prioridad_crr_crr', 'estado', 'fecha_crea', 'usuario_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerEmailUser($id)
    {
        $this->select('id_correo as id, correo, prioridad_crr as prioridad');
        $this->where('id_usuario', $id);
        $data = $this->find();
        return $data;
    }
    public function EmailPrincipal($idUsuario)
    {
        $this->select('correo');
        $this->where('id_usuario', $idUsuario);
        $this->where('prioridad_crr', 'P');
        $data = $this->first();
        return $data;
    }

    public function buscarEmail($correo, $idUsuario)
    {
        $this->select('*');
        $this->where('correo', $correo);
        if ($idUsuario != 0) {
            $this->where('id_usuario', $idUsuario);
        }
        $data = $this->first();
        return $data;
    }

}
