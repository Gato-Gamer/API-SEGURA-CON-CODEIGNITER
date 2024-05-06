<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCliente extends Migration
{
    public function up()
    {
        //Creacion de la tabla cliente
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true
            ],
            'retainer_fee' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => false,
                'unique' => true
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp', ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cliente');
    }

    public function down()
    {
        //Para eliminar nuestra tabla
        $this->forge->dropTable('cliente');
    }
}
