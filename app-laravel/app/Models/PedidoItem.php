<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedido_itens';

    protected $primaryKey = 'id_pedido_item';

    protected $fillable = ['id_pedido', 'id_produto', 'qtde', 'preco'];

    // Relacionamento: Um item de pedido pertence a um pedido (muitos para um)
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    // Relacionamento: Um item de pedido pertence a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}
