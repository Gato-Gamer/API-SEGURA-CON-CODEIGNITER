<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModeloUsuario extends Model
{
    protected $table = 'usuario';//nombre de la tabla
    protected $allowedFields = [
        'name', 'email', 'password'
    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {
        return $this->getContrasenaActualizadaConHashed($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getContrasenaActualizadaConHashed($data);
    }

    private function getContrasenaActualizadaConHashed(array $data): array
    {
        if (isset($data['data']['password'])) {//exieste dentro de data un campo password?
            $plaintextPassword = $data['data']['password'];//obtiene en texto plano
            $data['data']['password'] = password_hash($plaintextPassword, PASSWORD_BCRYPT);
        }

        return $data;
    }

    public function buscarUsuarioPorEmail(string $emailAddress) {
        $user = $this->asArray()->where(['email' => $emailAddress])->first();//almacena el email buscado en user

        if (!$user) {
            throw new Exception('Usuario no encontrado con el email indicado');
        }
        return $user;
    }
}