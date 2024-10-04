<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $primaryKey = 'id_produto';

    protected $fillable = ['nome', 'preco'];

    // Relacionamento: Um produto pode estar em vários itens de pedido (um para muitos)
    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class, 'id_produto');
    }
}