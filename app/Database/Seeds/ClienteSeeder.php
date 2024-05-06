<?php

namespace App\Database\Seeds;

use CodeIgniter\Config\Factory;
use CodeIgniter\Database\Seeder;
use Faker\Factory as FakerFactory;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i<10;$i++){
            $this->db->table('cliente')->insert($this->generarCliente());
        }
    }
    private function generarCliente(): array
    {
        $faker = FakerFactory::create();
        return [
            'name' => $faker->name(),
            'email' => $faker->email,
            'retainer_fee' => random_int(10000, 100000000)
        ];
    }
}
