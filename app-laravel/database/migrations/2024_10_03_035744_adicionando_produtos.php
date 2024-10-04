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
        DB::table('produtos')->insert([
            [
                'nome' => 'Produto A',
                'preco' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Produto B',
                'preco' => 29.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Produto C',
                'preco' => 39.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Produto D',
                'preco' => 49.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Produto E',
                'preco' => 59.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('produtos')->whereIn('nome', ['Produto A', 'Produto B', 'Produto C', 'Produto D', 'Produto E'])->delete();
    }
};
