<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
      
    protected $table = "ventas";

    protected $fillable = [
        'id_sucursal',
        'codigo',
        'id_cliente',
        'id_vendedor',
        'impuesto',
        'neto',
        'total',
        'metodo_pago',
        'fecha',
        'estado'
    ];

    
    public $timestamps = false;

    public function VENDEDOR()
    {
        return $this->belongsTo(User::class, 'id_vendedor');
    }

    public function CLIENTE()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }



    
}
