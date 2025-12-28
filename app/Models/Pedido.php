<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos'; 

    protected $fillable = [
        'usuario_id',
        'estado',
        'total',
        'metodo_pago',
        'notas_cliente',
        'notas_admin',
        'transbank_token',
        'transbank_authorization_code',
        'transbank_buy_order',
        'transbank_payment_type_code',
        'transbank_amount',
        'transbank_transaction_date',
        'transbank_response',
        // Campos para compras sin registro (guest checkout)
        'nombre_cliente',
        'email_cliente',
        'telefono_cliente',
        'direccion_cliente',
        'comuna_cliente',
    ];

    protected $casts = [
        'transbank_response' => 'array',
        'transbank_transaction_date' => 'datetime',
    ];

    /**
     * Relación: Un pedido pertenece a un usuario (puede ser NULL para guest checkout).
     */
    public function usuario()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Relación: Un pedido tiene muchos ítems (productos) de pedido.
     */
    public function items()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
