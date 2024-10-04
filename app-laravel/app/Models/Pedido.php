<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $primaryKey = 'id_pedido';

    protected $fillable = ['data', 'id_cliente'];

    // Relacionamento: Um pedido pertence a um cliente (muitos para um)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function itens()
    {
        return $this->hasMany(PedidoItem::class, 'id_pedido', 'id_pedido');
    }
}