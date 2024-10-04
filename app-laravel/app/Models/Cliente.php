<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    protected $fillable = ['nome', 'email'];

    // Relacionamento: Um cliente pode ter muitos pedidos (um para muitos)
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente');
    }
}
