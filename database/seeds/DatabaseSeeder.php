<?php

use Illuminate\Database\Seeder;
use App\Loja;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Loja::create([
            'nome' => 'Raffs',
            'bairro' => 'bairro tal',
            'numero' => 89,
            'img' => 'caminhoqualquuer',
            'endereco' => 'rua tal',
            'wp' => '219389182',
            'tell' => '02193093209321',
            'sobre' => 'nothing about',
        ]);

    }
}
