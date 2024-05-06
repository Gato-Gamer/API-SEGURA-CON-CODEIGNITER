<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloCliente extends Model
{
    protected $table = 'cliente';//nombre de la tabla
    protected $allowedFields = [
        'name', 'email', 'retainer_fee'
    ];// campos de la tabla

    protected $useTimestamps = true;
    protected $updatedField = 'updated_at';

    public function buscarClienteById($id)
    {// nos permite recuperar el cliente por id
        $cliente = $this->asArray()->where(['id' => $id])->first();//

        if (!$cliente) {
            throw new \Exception('No se encontro el cliente para el id especificado');
        }

        return $cliente;
    }
}