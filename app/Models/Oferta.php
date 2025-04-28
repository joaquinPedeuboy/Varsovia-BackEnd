<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'precio_oferta',
        'stock_oferta'
    ];

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'producto_oferta');
    }
}
