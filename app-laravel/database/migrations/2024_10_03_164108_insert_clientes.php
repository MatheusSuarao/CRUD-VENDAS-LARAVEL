<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Inserir 5 clientes de exemplo na tabela clientes
        DB::table('clientes')->insert([
            [
                'nome' => 'João Silva',
                'email' => 'joao.silva@example.com',
            ],
            [
                'nome' => 'Maria Oliveira',
                'email' => 'maria.oliveira@example.com',
            ],
            [
                'nome' => 'Carlos Souza',
                'email' => 'carlos.souza@example.com',
            ],
            [
                'nome' => 'Ana Pereira',
                'email' => 'ana.pereira@example.com',
            ],
            [
                'nome' => 'Lucas Almeida',
                'email' => 'lucas.almeida@example.com',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove os clientes de exemplo inseridos
        DB::table('clientes')->whereIn('email', [
            'joao.silva@example.com',
            'maria.oliveira@example.com',
            'carlos.souza@example.com',
            'ana.pereira@example.com',
            'lucas.almeida@example.com'
        ])->delete();
    }
};
