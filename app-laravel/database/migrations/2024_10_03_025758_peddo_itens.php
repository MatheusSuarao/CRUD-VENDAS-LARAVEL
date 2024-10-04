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
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->id('id_pedido_item');
            $table->foreignId("id_pedido")->references("id_pedido")->on("pedidos")->onDelete("cascade");
            $table->foreignId("id_produto")->references("id_produto")->on("produtos")->onDelete("cascade");
            $table->integer('qtde');
            $table->decimal('preco', 10, 2);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pedido_itens');
    }
    
};
