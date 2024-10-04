<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->foreignId("id_cliente")->references("id_cliente")->on("clientes")->onDelete("cascade");
            $table->date('data');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
    
};
